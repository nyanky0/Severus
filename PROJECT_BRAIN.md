# PROJECT BRAIN - SEVERUS CUES

## 0. Versioning & Release Tracking (NEW BASE — v2.0.0)
- **Semantic Versioning** is enforced. Canonical version lives in the root **`VERSION`** file (`2.0.0`).
- `app/Support/Version.php` exposes `Version::current()`, `Version::short()`, `Version::slug()` — displayed as a **BUILD badge** in the site footer and admin dashboard.
- `CHANGELOG.md` documents every release (Keep a Changelog format).
- **composer.json** `version` must stay in sync with `VERSION` on each release.
- Tag each release (`git tag v2.0.0`) and `git push --tags origin main`.

## 1. Project Overview
**Severus Cues** is a high-performance web application for marketing premium billiard/pool cues, high-friction chalk, and specialized billiard accessories. Built with **Laravel PHP**, **Tailwind CSS**, **Alpine.js**, **anime.js**, and **Docker**.

- **Brand Aesthetic (v2.0 — "Reaper Edition": Grim Reaper / Snake theme, RED ONLY)**:
  - **Base**: Obsidian Black (`#060506` / `#080608`).
  - **Primary / Accent**: Reaper Crimson (`#E23B3B` / `#FF4D5E`). **No green theme** — the Venom emerald theme and its toggle were removed; red is the single theme app-wide (landing, admin, product pages, scrollbar, selection, text glows).
  - **Signatures**: CSS-generated **snake-scale overlay** (`.snake-scale-overlay`, red-tinted) over infinite-panning `carbon_background.jpg` (`.reaper-infinite-bg`), **serpent shimmer** (`.serpent-shimmer`) on badges, **ember particles** rising in hero, **orbital rings + slanted 3D cue**, **Cinzel** serif for reaper-luxury type, **Outfit** for industrial headings.
  - **No theme switcher** — the dual Venom ⇄ Reaper toggle and `localStorage('severus_theme')` were removed; `currentTheme` is gone from all views (static red bindings only).
- **Target Audience**: Professional cue sport players, billiard enthusiasts, pool hall operators, online shoppers.
- **Primary Shop Integration**: Tokopedia Store (`https://www.tokopedia.com/severus`), Shopee Store, Instagram.

## 2. Key Technical Features
0. **Beautified CSS — now actually served**: `resources/css/app.css` is the source of truth and is copied to `public/css/app.css`. It is a full design-token + utility system: `@layer base` (CSS custom properties for the reaper-red theme, scales, easing curves) and `@layer utilities` (premium glass cards, glow buttons, corner frames, fang underline, gradient-blur navbar, glow text, all keyframe animations). **Keep both copies in sync on every CSS edit.**
1. **anime.js entrance choreography** on the landing hero (staggered copy reveal, cue scale-up, glow bloom) loaded from CDN and wired via `@push('scripts')` / `@stack('scripts')`. Fully `prefers-reduced-motion` safe.
2. **Single Red Theme (Reaper)** — no theme switcher. All `currentTheme`/`localStorage('severus_theme')` logic removed from views; classes are static red bindings.
3. **"Why Switch to Carbon?" showcase** (`#why-carbon`): `WHY SWITCH TO CARBON?` display headline, serpent-shimmer SEVERUS CUES badge, corner-frame cards, banner copy from `SiteContent`, full EN/ID coverage.
4. **Multi-Language Support (EN & ID)**: locale switcher with session persistence via `SetLocale` middleware; full translation coverage.
5. **Top-to-Down Gradient Blur Navbar & Alpine.js Auto-Scroll**: `navbar-gradient-blur--reaper` (red-tinted); smooth `scrollTo(id)` (90px offset) for `#home`, `#why-carbon`, `#cues`, `#technology`.
6. **100% Mobile Web Compatibility**: `min-h-[48px]` touch targets, hamburger slide-over drawer, stacked responsive grids (`grid-cols-1 sm:... lg:...`), `viewport-fit=cover` + safe-area friendly.
7. **Hardened Team Portal Auth & Rate Limiting**: `/admin` redirects guests to `/admin/login`; `throttle:6,1` blocks brute-force; manual product CRUD + content editing.
8. **Hero**: left status badge + display type + CTAs (Explore / Tokopedia / Shopee / Instagram) + guarantee badge; right 3D orbital rings, ambient glow, floating slanted cue (`animate-slanted-cue`), HUD glass tag.
9. **Docker Infrastructure**: separated `severus-db` (PostgreSQL 16), `severus-backend` (PHP 8.3-FPM, pdo_pgsql/GD/BCMath/Zip), `severus-frontend` (Nginx Alpine, static caching).
10. **Gaming PC Utility Scripts**: `severus-on.bat` boots + migrates + serves `http://localhost:8000`; `severus-off.bat` downs all containers to free CPU/RAM.

## 3. Technology Stack
- **Framework**: Laravel 11 / 13 ready (PHP 8.3)
- **Database**: PostgreSQL 16 (`postgres:16-alpine`)
- **Frontend / Styling**: Tailwind CSS (CDN), Alpine.js, Cinzel / Outfit / Inter / JetBrains Mono fonts
- **Animation**: anime.js v4 (CDN) + CSS keyframes (serpent shimmer, ember particles, orbit rings, cue float)
- **Web Server**: Nginx Alpine
- **Containerization**: Docker & Docker Compose
- **Version Control**: Git & GitHub (`https://github.com/nyanky0/Severus.git`) — semantic tags + CHANGELOG per release

## 4. Database / Models
**Models**: `User`, `Category`, `Product`, `SiteContent`, `TokopediaSyncLog`.
**Relations**: `Product → Category`, `Product → TokopediaSyncLog` (hasMany).
**Localized accessors**: `name`, `description`, `category.name/description`, `siteContent.value` resolve by current locale (`en`/`id`).
**Migrations**: users, categories, products (full cue specs + pricing + stock), site_contents, tokopedia_sync_logs.

## 5. Development & Execution Guide
### Turn ON
```cmd
severus-on.bat
```
- Public: `http://localhost:8000`
- Admin: `http://localhost:8000/admin` (`admin@severus.com` / `severus123`)

### Turn OFF
```cmd
severus-off.bat
```

## 6. Maintenance & Manual Commands
- Tokopedia price sync: `docker compose exec backend php artisan severus:sync-tokopedia`
- Re-seed DB: `docker compose exec backend php artisan db:seed --force`
- Logs: `docker compose logs -f`

### Environment / Cache Path Note (IMPORTANT)
- Laravel requires the **`storage/framework/` tree** (`views`, `cache/data`, `sessions`, `testing`) plus `storage/app` to exist — these keep Laravel alive via committed `.gitignore` placeholders. **Never delete these directories.** Their absence causes `InvalidArgumentException: Please provide a valid cache path` (Blade compiler 500).
- `config/view.php` must not be removed — it sets `compiled` to `realpath(storage_path('framework/views'))`. This repo now ships it (was missing from scaffold).
- If the 500 "valid cache path" ever reappears after a fresh clone: run `mkdir storage/framework/views storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/app` or simply `php artisan view:clear` after `composer install`.

## 7. Git Backup Policy
- **Mandatory Backup Push**: After any feature/edit/fix run `git add -A`, `git commit`, `git push origin main` (and `git push --tags`) to back up to `https://github.com/nyanky0/Severus.git`.
- **New release checklist**: bump `VERSION` + `composer.json version` + add CHANGELOG entry → commit → `git tag vX.Y.Z` → push all.
