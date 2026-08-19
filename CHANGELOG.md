# Changelog

All notable changes to **Severus Cues** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.2] - 2026-08-19

### Changed
- **Removed the green/Venom theme entirely.** The dual Venom ⇄ Reaper theme toggle
  was deleted; `currentTheme` and `localStorage('severus_theme')` logic removed
  from the landing and layout views.
- The app now uses a **single red Grim-Reaper theme** app-wide: landing, admin
  portal (dashboard, login, product CRUD, contents) and product pages.
- CSS purged of all green (`#00E676`) tokens: scrollbar, text selection, text
  glows (`text-glow-venom` → `text-glow-reaper`), venom glass cards, `btn-venom`,
  green snake-scale overlay, green navbar, green ember particles, green border
  pulses. Both `resources/css/app.css` and `public/css/app.css` kept in sync.
- Static red bindings (`#E23B3B` / `#FF4D5E`) replace every dynamic theme class;
  only genuine Alpine state bindings remain (filter tabs, scrolled header,
  product modal).

## [2.0.1] - 2026-08-19

### Fixed
- **HTTP 500 — `InvalidArgumentException: Please provide a valid cache path`**.
  Root cause: `config/view.php` was missing from the scaffold, so
  `config('view.compiled')` resolved to `null`; and the `storage/framework/`
  tree (`views`, `cache/data`, `sessions`, `testing`) plus `storage/app` never
  existed on a fresh clone. The Blade compiler therefore received an empty
  compiled-view cache path.
- Added `config/view.php` (`compiled` → `realpath(storage_path('framework/views'))`).
- Rebuilt the full `storage/framework/` + `storage/app` tree with committed
  `.gitignore` placeholders so the directories survive fresh clones.
- Documented the environment/cache-path note in `PROJECT_BRAIN.md`.
- Verified live via `php artisan serve`: landing 200, admin guest redirect 302,
  product page 200.

## [2.0.0] - 2026-08-19

### Added
- **Semantic versioning system**: `VERSION` file, `app/Support/Version.php` helper, runtime version read, and visible build version badge in the site footer.
- **Grim Reaper / Snake visual identity** — "SEVERUS: REAPER EDITION":
  - Obsidian-black base palette with emerald **snake (venom)** primary and crimson **reaper** accent.
  - CSS-generated **snake-scale texture overlay** (pure CSS, no extra asset) over the existing infinite-panning carbon background.
  - Repair-scythe SVG brand motif and skull/diamond accent marks in the hero and finale.
  - Animated **serpent shimmer** sweeping the hero emblem.
- **Premium design-token CSS system** (`resources/css/app.css`):
  - CSS custom properties for the dual theme (venom / reaper).
  - Reaper obsidian/venom glass cards, glow buttons, corner frames, and slanted-cue orbital stage.
  - 60fps keyframe animations: serpent shimmer, cue slanted float, orbit rings, ember rise.
- **anime.js-powered entrance choreography** on the landing hero (staggered text reveal, cue-scale entrance, glow bloom) loaded from CDN.
- **Mobile-first + mobile-design skills** applied: 44px+ touch targets, stacked responsive grids, safe-area handling.

### Changed
- Overall style upgraded from carbon-red-only to a **dual grim-reaper/snake** dark theme (venom emerald primary, reaper crimson accent) while preserving both Liquid-Glass carousel sections.
- Restructured `resources/css/app.css` around a maintainable token/utility layer.
- Landing copy re-tuned through the anti-slop writing discipline (sharper, more concrete, fewer AI-isms) — EN + ID.

### Fixed
- Version-aware footer now renders the current build via `Version::current()`.

### Security
- Admin portal unchanged: rate-limited login (`throttle:6,1`), auth-gated routes, guest redirect to `/admin/login`.

## [1.0.0] - 2026-06-xx (Baseline, Carbon Red Edition)

The original Carbon-Red / Venom-Green dual-theme marketing app for premium billiard
cues, chalk and accessories (Laravel 11 / Tailwind / Alpine / Docker / PostgreSQL).
Events before this version are maintained as an un-versioned history in git.
