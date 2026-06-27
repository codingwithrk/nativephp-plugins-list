# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What This Project Is

A curated directory of NativePHP Mobile plugins, stored as Markdown files and published as a static site via [Docsmith](https://github.com/MrPunyapal/docsmith).

## Commands

```bash
# Install dependencies
composer install

# Build the static docs site (output goes to docs/)
composer docs:build
# which runs: php build-docs.php
```

The `build-docs.php` script in the root drives the Docsmith build. If it doesn't exist yet, create it following the pattern in `vendor/mrpunyapal/docsmith/README.md`.

## Architecture

**Plugin listings** live in two directories:
- `plugins/free/` — free plugins, one `.md` file per plugin
- `plugins/paid/` — paid/commercial plugins, one `.md` file per plugin

**Build pipeline**: Docsmith reads the `plugins/` directory tree (or a configured `md/` source), renders each `.md` to HTML, generates `search-index.json` and `sitemap.xml`, and writes everything to `docs/` for GitHub Pages hosting.

**`build-docs.php`** wires Docsmith to this repo's source directories and site metadata (title, description, accent color, repository URL, etc.). See `vendor/mrpunyapal/docsmith/src/Docsmith.php` for the full fluent API.

## Plugin File Convention

Each plugin is a single Markdown file named `{author-handle}-{plugin-name}.md` (e.g. `jvdluk-pro-vibration.md`). Free vs paid placement determines the directory.
