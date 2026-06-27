<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Docsmith\Docsmith;

// ── Helpers ──────────────────────────────────────────────────────────────────

/**
 * Parse YAML frontmatter from a markdown file.
 * Returns [frontmatter array, body string without the --- block].
 */
function parseFrontmatter(string $content): array
{
    $content = str_replace("\r\n", "\n", $content);

    if (! str_starts_with($content, "---\n")) {
        return [[], $content];
    }

    if (! preg_match('/\A---\n(?P<meta>.*?)\n---\n(?P<body>.*)\z/s', $content, $m)) {
        return [[], $content];
    }

    $meta       = [];
    $currentKey = null;
    $isArray    = false;

    foreach (explode("\n", $m['meta']) as $line) {
        // Indented object key:  key: "value"
        if (preg_match('/^ {2}([\w-]+):\s*"?([^"]*)"?\s*$/', $line, $nm)) {
            if (is_array($meta[$currentKey] ?? null)) {
                $meta[$currentKey][$nm[1]] = trim($nm[2], '"\'');
            }
            $isArray = false;
        }
        // Indented array item:  - "value"
        elseif (preg_match('/^ {2}-\s*"?(.+?)"?\s*$/', $line, $am) && $currentKey && $isArray) {
            $meta[$currentKey][] = trim($am[1], '"\'');
        }
        // Top-level quoted:  key: "value"
        elseif (preg_match('/^([\w-]+):\s*"(.*)"\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = $km[2];
            $isArray           = false;
        }
        // Top-level unquoted:  key: value
        elseif (preg_match('/^([\w-]+):\s+(\S.*)\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = trim($km[2], '"\'');
            $isArray           = false;
        }
        // Top-level block:  key: (array/map follows)
        elseif (preg_match('/^([\w-]+):\s*$/', $line, $km)) {
            $currentKey        = $km[1];
            $meta[$currentKey] = [];
            $isArray           = true;
        }
    }

    return [$meta, ltrim($m['body'], "\n")];
}

function esc(string $v): string
{
    return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Build a styled HTML info card from plugin frontmatter.
 */
function pluginCard(array $meta): string
{
    $author  = (string) ($meta['author']  ?? '');
    $price   = (string) ($meta['price']   ?? 'Free');
    $version = (string) ($meta['version'] ?? '');
    $license = (string) ($meta['license'] ?? '');
    $github  = (string) ($meta['github']  ?? '');
    $source  = (string) ($meta['source']  ?? '');
    $compat  = is_array($meta['compatibility'] ?? null) ? $meta['compatibility'] : [];

    $isPaid         = strtolower($price) !== 'free';
    $badgeClass     = $isPaid ? 'pi-badge-paid' : 'pi-badge-free';
    $isFirstParty   = strtolower($author) === 'bifrost technology';
    $partyBadge     = $isFirstParty ? 'pi-badge-first-party' : 'pi-badge-community';
    $partyLabel     = $isFirstParty ? '1st Party Plugin' : 'Community Plugin';

    $html  = '<div class="plugin-info">';

    // ── Meta row ─────────────────────────────────────────────────────────────
    $html .= '<div class="pi-meta">';

    if ($author !== '') {
        $html .= '<span class="pi-item"><span class="pi-label">Author</span>'
               . '<span class="pi-value">' . esc($author) . '</span></span>';
    }

    $html .= '<span class="pi-item"><span class="pi-label">Plugin Type</span>'
           . '<span class="pi-badge ' . $partyBadge . '">' . $partyLabel . '</span></span>';

    if ($price !== '') {
        $html .= '<span class="pi-item"><span class="pi-label">Price</span>'
               . '<span class="pi-badge ' . $badgeClass . '">' . esc($price) . '</span></span>';
    }

    if ($version !== '') {
        $html .= '<span class="pi-item"><span class="pi-label">Version</span>'
               . '<span class="pi-value">v' . esc($version) . '</span></span>';
    }

    if ($license !== '') {
        $html .= '<span class="pi-item"><span class="pi-label">License</span>'
               . '<span class="pi-value">' . esc($license) . '</span></span>';
    }

    $html .= '</div>';

    // ── Compatibility chips ───────────────────────────────────────────────────
    if ($compat !== []) {
        $labels = [
            'nativephp' => 'NativePHP',
            'ios'       => 'iOS',
            'android'   => 'Android',
            'php'       => 'PHP',
            'laravel'   => 'Laravel',
        ];
        $html .= '<div class="pi-compat">';
        foreach ($compat as $k => $v) {
            $v = (string) $v;
            if (strtolower($v) === 'not supported') {
                continue;
            }
            $label = $labels[$k] ?? ucfirst((string) $k);
            $html .= '<span class="pi-chip">'
                   . '<span class="pi-chip-label">' . esc($label) . '</span>'
                   . '<span class="pi-chip-value">' . esc($v) . '</span>'
                   . '</span>';
        }
        $html .= '</div>';
    }

    // ── Links ────────────────────────────────────────────────────────────────
    $links = [];

    if ($github !== '') {
        $links[] = '<a href="' . esc($github) . '" class="pi-link" target="_blank" rel="noopener">GitHub →</a>';
    }

    if ($source !== '') {
        $links[] = '<a href="' . esc($source) . '" class="pi-link pi-link-buy" target="_blank" rel="noopener">Buy on NativePHP →</a>';
    }

    if ($links !== []) {
        $html .= '<div class="pi-links">' . implode('', $links) . '</div>';
    }

    $html .= '</div>' . "\n\n";

    return $html;
}

// ── Preprocess plugin files into .build/ ─────────────────────────────────────

$buildDir = __DIR__ . '/.build';

foreach (['free', 'paid'] as $cat) {
    $dir = "$buildDir/plugins/$cat";
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

foreach (['free', 'paid'] as $category) {
    foreach (glob(__DIR__ . "/plugins/$category/*.md") ?: [] as $srcFile) {
        $raw           = (string) file_get_contents($srcFile);
        [$meta, $body] = parseFrontmatter($raw);
        $card          = $meta !== [] ? pluginCard($meta) : '';
        file_put_contents(
            "$buildDir/plugins/$category/" . basename($srcFile),
            $card . $body
        );
    }
}

// Copy README to .build/ so its relative links resolve to .build/plugins/...
copy(__DIR__ . '/README.md', "$buildDir/README.md");

// ── Build ────────────────────────────────────────────────────────────────────

Docsmith::make()
    ->readmeIndex("$buildDir/README.md")
    ->output(__DIR__ . '/docs')
    ->title('NativePHP Plugins List')
    ->description('A curated directory of plugins for NativePHP Mobile.')
    ->customCss(__DIR__ . '/custom.css')
    ->build();

// ── Cleanup ──────────────────────────────────────────────────────────────────

foreach (['free', 'paid'] as $cat) {
    foreach (glob("$buildDir/plugins/$cat/*.md") ?: [] as $f) {
        unlink($f);
    }
    @rmdir("$buildDir/plugins/$cat");
}

@unlink("$buildDir/README.md");
@rmdir("$buildDir/plugins");
@rmdir($buildDir);
