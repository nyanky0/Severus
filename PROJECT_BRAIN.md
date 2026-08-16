# PROJECT BRAIN - SEVERUS CUES

## 1. Project Overview
**Severus Cues** is a high-performance web application designed for marketing premium billiard/pool cues, high-friction chalk, and specialized billiard accessories. It is built using **Laravel PHP**, **Tailwind CSS**, **Alpine.js**, and **Docker**.

- **Brand Aesthetic**: "Venom Snake Green" (`#0A0F0D` Obsidian Dark base, `#00E676` Toxic Emerald Green glow, `#10B981` Emerald Accent, `#141D17` Glass Card backdrop).
- **Target Audience**: Professional cue sport players, billiard enthusiasts, pool hall operators, and online shoppers.
- **Primary Shop Integration**: Tokopedia Store (`https://www.tokopedia.com/severus`).

---

## 2. Key Technical Features
1. **Multi-Language Support (EN & ID)**:
   - English & Indonesian locale switcher.
   - Session/Cookie persistence via `SetLocale` middleware.
   - Full translation coverage across products, cue technology attributes, hero banners, and team portal.
2. **Top-to-Down Gradient Blur Navbar & Smooth Scroll**:
   - Fixed top navbar with top-to-bottom bold-to-light gradient backdrop blur (`.navbar-gradient-blur`).
   - Smooth offset anchor navigation (`scroll-behavior: smooth`, `scroll-padding-top: 6rem`) preventing header overlap.
   - Fluid window resize handling without Cumulative Layout Shift (CLS).
3. **100% Mobile Web Compatibility & Mobile Drawer**:
   - Touch-friendly hit targets (`min-h-[48px]`).
   - Mobile hamburger menu button with smooth slide-over drawer navigation.
   - Responsive multi-column to single-column card layouts.
4. **Framer Motion Style Micro-Animations**:
   - `IntersectionObserver` scroll reveals (`.reveal-on-scroll`, `.reveal-visible`).
   - Staggered animation delays (`delay-100`, `delay-200`, `delay-300`).
   - Hover scale glow effects on cue cards, buttons, badges, and technology feature blocks.
5. **Separated Docker Infrastructure**:
   - `severus-db`: PostgreSQL 16 database service (`postgres:16-alpine`).
   - `severus-backend`: PHP 8.3-FPM container with PDO, `pdo_pgsql`, `pgsql`, GD, BCMath, Zip extensions.
   - `severus-frontend`: Nginx web server configured for Laravel with static asset caching.
6. **Gaming PC Utility Scripts**:
   - `severus-on.bat`: Boots all containers, runs database migrations/seeders, and exposes application at `http://localhost:8000`.
   - `severus-off.bat`: Gracefully downs all Docker containers to restore 100% CPU/RAM for gaming performance.
7. **Dual Application Portals**:
   - **Customer Landing Portal (`/`)**: Top fixed glassmorphism navbar, hero banner, interactive cue catalog, cue technology breakdown, spec sheets, and direct Tokopedia buy links.
   - **Inside Team Admin Portal (`/admin`)**: Product management, image uploader, content banner management, Tokopedia live price monitor, and manual overrides.
8. **Tokopedia Store Integration & Product Scraper**:
   - Price Sync: `php artisan severus:sync-tokopedia`.
   - Store Product Scraper: `php artisan severus:scrape-tokopedia` (crawls items directly from `https://www.tokopedia.com/severus/product`).

---

## 3. Technology Stack
- **Framework**: Laravel 11 / 13 ready (PHP 8.3)
- **Database**: PostgreSQL 16 (`postgres:16-alpine`)
- **Frontend / Styling**: Tailwind CSS, Alpine.js, Inter & Outfit Google Fonts, Custom CSS Design Tokens
- **Animations**: Framer Motion style IntersectionObserver & CSS Keyframe Micro-Interactions
- **Web Server**: Nginx Alpine
- **Containerization**: Docker & Docker Compose
- **Version Control**: Git & GitHub (`https://github.com/nyanky0/Severus.git`)

---

## 4. Database Schema Overview

```
 +------------------+       +------------------+
 |    categories    |       |     products     |
 +------------------+       +------------------+
 | id               |<------| id               |
 | name_en / name_id|       | category_id      |
 | slug             |       | name_en / name_id|
 | created_at...    |       | description_...  |
 +------------------+       | price_idr        |
                            | price_usd        |
                            | tokopedia_url    |
                            | image_path       |
                            | tip_size         |
                            | joint_type       |
                            | weight_oz        |
                            | deflection_grade |
                            | chalk_friction   |
                            | is_featured      |
                            | is_active        |
                            +------------------+
                                     |
                                     v
                        +--------------------------+
                        |   tokopedia_sync_logs    |
                        +--------------------------+
                        | id                       |
                        | product_id               |
                        | old_price_idr            |
                        | new_price_idr            |
                        | status                   |
                        | synced_at                |
                        +--------------------------+
```

---

## 5. Development & Execution Guide

### Turn ON Development Environment
Run from project root:
```cmd
severus-on.bat
```
Access points:
- Public Customer App: `http://localhost:8000`
- Inside Team Admin: `http://localhost:8000/admin` (Default Credentials: `admin@severus.com` / `severus123`)

### Turn OFF Development Environment (Gaming Mode)
Run from project root:
```cmd
severus-off.bat
```
This stops and removes all active containers, freeing 100% of RAM and CPU.

---

## 6. Maintenance & Manual Commands
- **Run Tokopedia Price Sync**: `docker compose exec backend php artisan severus:sync-tokopedia`
- **Re-seed Database**: `docker compose exec backend php artisan db:seed --force`
- **View Container Logs**: `docker compose logs -f`

---

## 7. Git Backup Policy
- **Mandatory Backup Push**: Always execute `git add`, `git commit`, and `git push origin main` after making changes, features, or fixes to ensure the repository at `https://github.com/nyanky0/Severus.git` is updated as a remote backup.

