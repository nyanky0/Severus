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
2. **Top-to-Down Gradient Blur Navbar & Alpine.js Auto-Scroll**:
   - Fixed top navbar with top-to-bottom bold-to-light gradient backdrop blur (`.navbar-gradient-blur`).
   - Smooth animated section auto-scroll (`scrollTo(id)` method calculating target offset minus 90px header height) for `#home`, `#cues`, `#chalk`, and `#technology`.
   - Streamlined navbar navigation: `Home`, `Collection`, `Viper Tech` (all cues, chalks, and billiard accessories are available in the Venom Collection catalog filter tabs).
3. **100% Mobile Web Compatibility & Mobile Drawer**:
   - Touch-friendly hit targets (`min-h-[48px]`).
   - Mobile hamburger menu button with smooth slide-over drawer navigation.
4. **Hardened Team Portal Auth & Rate Limiting**:
   - Accessing `/admin` automatically redirects unauthenticated users to `/admin/login`.
   - Rate limiting (`throttle:6,1`) blocks brute-force login attacks and SQL injection probes.
   - Manual product catalog creation, editing, and content management.
5. **Store & Social Media Hero Placement**:
   - Clean top header navbar (branding logo, `Home`, `Collection`, `Viper Tech`, language switcher, and admin link).
   - Hero section CTA suite: `Explore Products`, `Tokopedia` (Green Owl Bag logo), `Shopee` (Orange 'S' Bag logo), and `Instagram` (`https://www.instagram.com/severuscues/` placed directly after Shopee).
   - Streamlined clean footer displaying brand copyright without redundant bottom links.
6. **Separated Docker Infrastructure**:
   - `severus-db`: PostgreSQL 16 database service (`postgres:16-alpine`).
   - `severus-backend`: PHP 8.3-FPM container with PDO, `pdo_pgsql`, `pgsql`, GD, BCMath, Zip extensions.
   - `severus-frontend`: Nginx web server configured for Laravel with static asset caching.
7. **Gaming PC Utility Scripts**:
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

