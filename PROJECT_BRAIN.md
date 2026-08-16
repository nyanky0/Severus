# PROJECT BRAIN - SEVERUS CUES

## 1. Project Overview
**Severus Cues** is a high-performance web application designed for marketing premium billiard/pool cues, high-friction chalk, and specialized billiard accessories. It is built using **Laravel PHP**, **Tailwind CSS**, **Alpine.js**, and **Docker**.

- **Brand Aesthetic**:
  - **Default Theme (Carbon Red)**: Crimson Red (`#E51919` / `#DC2626`), Custom Infinite Smooth Scrolling Dark Carbon background (`carbon_background.jpg` asset with fixed smooth infinite CSS panning animation), Google Font `Cinzel` luxury serif display titles, white `SEVERUS CUES` accent badges, corner L-frame accent lines.
  - **Preserved Theme (Venom Green)**: Toxic Emerald Green (`#00E676` / `#10B981`), Obsidian Dark base (`#0A0F0D`), `Outfit` display typography, accessible via top navbar Theme Switcher.
- **Target Audience**: Professional cue sport players, billiard enthusiasts, pool hall operators, and online shoppers.
- **Primary Shop Integration**: Tokopedia Store (`https://www.tokopedia.com/severus`), Shopee Store, and Instagram.

---

## 2. Key Technical Features
1. **Dynamic Dual Theme Switcher (Carbon Red & Venom Green)**:
   - Live theme toggle in top navigation bar (desktop & mobile drawer) with LocalStorage persistence.
   - Default theme: **Carbon Red** featuring crimson red glows, white badge highlights, and luxury serif `Cinzel` display titles.
   - Preserved theme: **Venom Green** restoring original toxic emerald green accents.
2. **"Why Switch to Carbon?" Feature Showcase Section**:
   - Dedicated showcase section (`#why-carbon`) replicating reference design cards:
     - Header: "WHY SWITCH TO CARBON?" in red Cinzel serif font with signature white `SEVERUS CUES` badge.
     - Card 1 ("PRECISION AND POWER"): Top-left L-shaped corner accent frame line, uppercase copy, concluding highlight line, bottom right white badge.
     - Card 2 ("SMOOTH FEEL"): Horizontal title flanking accent lines, uppercase copy, concluding highlight line, center bottom white badge.
     - Card 3 ("STYLE"): Top-right L-shaped corner accent frame line, uppercase copy, concluding highlight line, top-right white badge.
   - Full English and Indonesian (`lang/en`, `lang/id`) translation coverage.
3. **Multi-Language Support (EN & ID)**:
   - English & Indonesian locale switcher.
   - Session/Cookie persistence via `SetLocale` middleware.
   - Full translation coverage across products, cue technology attributes, hero banners, and team portal.
4. **Top-to-Down Gradient Blur Navbar & Alpine.js Auto-Scroll**:
   - Fixed top navbar with top-to-bottom bold-to-light gradient backdrop blur (`.navbar-gradient-blur`).
   - Smooth animated section auto-scroll (`scrollTo(id)` method calculating target offset minus 90px header height) for `#home`, `#why-carbon`, `#cues`, and `#technology`.
   - Streamlined navbar navigation: `Home`, `Why Carbon?`, `Collection`, `Viper Tech`.
5. **100% Mobile Web Compatibility & Mobile Drawer**:
   - Touch-friendly hit targets (`min-h-[48px]`).
   - Mobile hamburger menu button with smooth slide-over drawer navigation and theme switcher button.
6. **Hardened Team Portal Auth & Rate Limiting**:
   - Accessing `/admin` automatically redirects unauthenticated users to `/admin/login`.
   - Rate limiting (`throttle:6,1`) blocks brute-force login attacks and SQL injection probes.
   - Manual product catalog creation, editing, and content management.
7. **Clean Hero Layout with 3D Diagonal Slanted `/` Pool Cue Visual**:
   - Clean top-aligned Hero section.
   - Left side: Live motion status badge (`• PRO BILLIARD EQUIPMENT`), display typography, and lead copy.
   - Right side: In-motion 3D orbital rings, ambient red/green glow aura, floating 3D carbon pool cue stick angled at a diagonal `/` slash tilt (`animate-slanted-cue`), and HUD glass spec tag (`SEVERUS / 01 - Zero-Deflection Carbon`).
   - Action CTA Suite: `Explore Products`, `Tokopedia` (Green Owl logo), `Shopee` (Orange 'S' logo), and `Instagram`.
   - Curved Dial & Stats section (`0.12mm Accuracy`, `99.8% Retention`, `Uni-Loc Joint`, `Rp 2.95M`).
   - `ENGINEERED BY SEVERUS CUES` display typography with 4 numbered spec cards (`01 Carbon Core`, `02 Toxic Chalk`, `03 TrueLock Pin`, `04 Pro Warranty`).
   - Signature Heart & Strike finale banner.
8. **Separated Docker Infrastructure**:
   - `severus-db`: PostgreSQL 16 database service (`postgres:16-alpine`).
   - `severus-backend`: PHP 8.3-FPM container with PDO, `pdo_pgsql`, `pgsql`, GD, BCMath, Zip extensions.
   - `severus-frontend`: Nginx web server configured for Laravel with static asset caching.
9. **Gaming PC Utility Scripts**:
   - `severus-on.bat`: Boots all containers, runs database migrations/seeders, and exposes application at `http://localhost:8000`.
   - `severus-off.bat`: Gracefully downs all Docker containers to restore 100% CPU/RAM for gaming performance.

---

## 3. Technology Stack
- **Framework**: Laravel 11 / 13 ready (PHP 8.3)
- **Database**: PostgreSQL 16 (`postgres:16-alpine`)
- **Frontend / Styling**: Tailwind CSS, Alpine.js, Inter & Outfit Google Fonts
- **Animations & Auto-Scroll**: Alpine.js Smooth Scroll Dispatcher & CSS Keyframe Reveals
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

