<?php

declare(strict_types=1);

/**
 * sync-versions.php
 *
 * Checks all plugins for version updates:
 *  - Free plugins → Packagist API
 *  - Paid plugins → nativephp.com plugin page (HTML scrape)
 *
 * Usage: php sync-versions.php
 * Exit code 0 always; prints a summary at the end.
 */

// ── Helpers ──────────────────────────────────────────────────────────────────

function parseVersion(string $raw): array
{
    $raw = ltrim($raw, 'vV');
    $parts = array_map('intval', explode('.', $raw));
    while (count($parts) < 3) {
        $parts[] = 0;
    }

    return $parts;
}

function versionGt(string $a, string $b): bool
{
    return parseVersion($a) > parseVersion($b);
}

function isStableVersion(string $v): bool
{
    $v = strtolower(ltrim($v, 'vV'));

    return ! preg_match('/dev|alpha|beta|rc|-/', $v)
        && preg_match('/^\d+\.\d+/', $v);
}

function latestFromPackagist(string $pkg): ?string
{
    $url = "https://packagist.org/packages/{$pkg}.json";
    $ctx = stream_context_create(['http' => [
        'user_agent' => 'NativePHP-Sync/1.0',
        'timeout'    => 10,
    ]]);

    $json = @file_get_contents($url, false, $ctx);
    if (! $json) {
        return null;
    }

    $data = json_decode($json, true);
    if (! isset($data['package']['versions'])) {
        return null;
    }

    $versions = array_filter(
        array_keys($data['package']['versions']),
        'isStableVersion'
    );

    if (empty($versions)) {
        return null;
    }

    usort($versions, fn ($a, $b) => parseVersion($a) <=> parseVersion($b));

    return ltrim(end($versions), 'vV');
}

function latestFromNativephpCom(string $sourceUrl): ?string
{
    $ctx = stream_context_create(['http' => [
        'user_agent' => 'Mozilla/5.0',
        'timeout'    => 10,
    ]]);

    $html = @file_get_contents($sourceUrl, false, $ctx);
    if (! $html) {
        return null;
    }

    // HTML pattern: <dt ...>Version</dt> ... <dd ...>1.0.3</dd>
    if (preg_match('/Version<\/dt>\s*<dd[^>]*>\s*([\d]+\.[\d]+\.[\d]+)\s*<\/dd>/s', $html, $m)) {
        return $m[1];
    }

    return null;
}

function parseFrontmatter(string $content): array
{
    $content = str_replace("\r\n", "\n", $content);

    if (! preg_match('/\A---\n(?P<meta>.*?)\n---\n(?P<body>.*)\z/s', $content, $m)) {
        return [[], $content];
    }

    $meta       = [];
    $currentKey = null;
    $isArray    = false;

    foreach (explode("\n", $m['meta']) as $line) {
        if (preg_match('/^ {2}([\w-]+):\s*"?([^"]*)"?\s*$/', $line, $nm)) {
            if (is_array($meta[$currentKey] ?? null)) {
                $meta[$currentKey][$nm[1]] = trim($nm[2], '"\'');
            }
            $isArray = false;
        } elseif (preg_match('/^ {2}-\s*"?(.+?)"?\s*$/', $line, $am) && $currentKey && $isArray) {
            $meta[$currentKey][] = trim($am[1], '"\'');
        } elseif (preg_match('/^([\w-]+):\s*"(.*)"\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = $km[2];
            $isArray           = false;
        } elseif (preg_match('/^([\w-]+):\s+(\S.*)\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = trim($km[2], '"\'');
            $isArray           = false;
        } elseif (preg_match('/^([\w-]+):\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = [];
            $isArray           = true;
        }
    }

    return [$meta, $m['body']];
}

function extractPackagistName(array $meta): ?string
{
    $installs = $meta['install'] ?? [];

    foreach ($installs as $cmd) {
        if (preg_match('/composer require ([a-zA-Z0-9_.\-]+\/[a-zA-Z0-9_.\-]+)/', $cmd, $m)) {
            return strtolower($m[1]);
        }
    }

    return null;
}

// ── Main ─────────────────────────────────────────────────────────────────────

$root    = __DIR__;
$updated = [];
$skipped = [];
$noChange = 0;

foreach (['free', 'paid'] as $category) {
    foreach (glob("{$root}/plugins/{$category}/*.md") ?: [] as $file) {
        $raw           = file_get_contents($file);
        [$meta, $body] = parseFrontmatter($raw);

        if (empty($meta)) {
            $skipped[] = basename($file) . ' (no frontmatter)';
            continue;
        }

        $currentVersion = (string) ($meta['version'] ?? '');
        $price          = (string) ($meta['price'] ?? 'Free');
        $sourceUrl      = (string) ($meta['source'] ?? '');

        // Skip plugins pinned to "latest"
        if (strtolower($currentVersion) === 'latest' || $currentVersion === '') {
            $skipped[] = basename($file) . ' (version=latest, skipped)';
            continue;
        }

        $latestVersion = null;

        if ($category === 'paid' && $sourceUrl !== '') {
            // Paid plugins: scrape nativephp.com
            $latestVersion = latestFromNativephpCom($sourceUrl);
        } else {
            // Free plugins: check Packagist
            $pkg = extractPackagistName($meta);
            if ($pkg === null) {
                $skipped[] = basename($file) . ' (no composer package)';
                continue;
            }
            $latestVersion = latestFromPackagist($pkg);
        }

        if ($latestVersion === null) {
            $skipped[] = basename($file) . " (couldn't fetch version)";
            continue;
        }

        if (! versionGt($latestVersion, $currentVersion)) {
            $noChange++;
            continue;
        }

        // Update the version line in the file
        $newRaw = preg_replace(
            '/^version:\s*"[^"]*"$/m',
            "version: \"{$latestVersion}\"",
            $raw
        );

        if ($newRaw === $raw) {
            $skipped[] = basename($file) . ' (regex did not match version line)';
            continue;
        }

        file_put_contents($file, $newRaw);
        $updated[] = sprintf('  %-55s %s → %s', basename($file), $currentVersion, $latestVersion);
    }
}

// ── Summary ──────────────────────────────────────────────────────────────────

$date = date('Y-m-d');

echo "Marketplace Sync — {$date}\n";
echo str_repeat('─', 60) . "\n";
echo 'Versions updated: ' . count($updated) . "\n";

if ($updated) {
    echo implode("\n", $updated) . "\n";
}

echo 'No change:        ' . $noChange . "\n";
echo 'Skipped:          ' . count($skipped) . "\n";

if ($skipped) {
    foreach ($skipped as $s) {
        echo "  - {$s}\n";
    }
}

echo "\n";
echo (count($updated) > 0 ? 'CHANGES_FOUND' : 'NO_CHANGES') . "\n";
