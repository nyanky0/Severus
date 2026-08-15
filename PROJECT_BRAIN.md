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
2. **Separated Docker Infrastructure**:
   - `severus-db`: MySQL 8.0 database service.
   - `severus-backend`: PHP 8.2-FPM container with PDO, GD, BCMath, Zip extensions.
   - `severus-frontend`: Nginx web server configured for Laravel with static asset caching.
3. **Gaming PC Utility Scripts**:
   - `severus-on.bat`: Boots all containers, runs database migrations/seeders, and exposes application at `http://localhost:8000`.
   - `severus-off.bat`: Gracefully downs all Docker containers to restore 100% CPU/RAM for gaming performance.
4. **Dual Application Portals**:
   - **Customer Landing Portal (`/`)**: Top fixed glassmorphism navbar, hero banner, interactive cue catalog, cue technology breakdown (carbon fiber shaft, high-friction nano chalk, glove ergonomics), spec sheets, and direct Tokopedia buy links.
   - **Inside Team Admin Portal (`/admin`)**: Product management, image uploader, content banner management, Tokopedia live price monitor, and manual overrides.
5. **Tokopedia Integration & Price Sync**:
   - Artisan sync command: `php artisan severus:sync-tokopedia`.
   - `TokopediaSyncService`: Fetches store pricing and availability from `https://www.tokopedia.com/severus` with automatic fallbacks and log audit trail.

---

## 3. Technology Stack
- **Framework**: Laravel 11 / PHP 8.2
- **Database**: MySQL 8.0
- **Frontend / Styling**: Tailwind CSS, Alpine.js, Inter & Outfit Google Fonts
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
