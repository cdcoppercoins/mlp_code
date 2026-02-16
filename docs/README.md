# MiniLicensePlates.com (mlp_code)

MiniLicensePlates.com is a PHP-based reference library of miniature license plate toys issued with candy, gum, and cereal promotions (plus related items).

## Live site
- Domain: https://minilicenseplates.com/
- Server (historical note): 72.52.161.52

## Core goals
- Fast visual browsing by set/issue/year
- Front/back viewing via hover (A/B images)
- Consistent sitewide layout (one CSS, one header, one footer)

## Tech stack
- Plain PHP (no framework)
- Single stylesheet: `public/main.css`
- Shared page shell includes:
    - `public/inc/page_top.php`
    - `public/inc/page_bottom.php`
    - `public/inc/modal_script.php`

## Key pages
- `public/index.php` — Home / intro
- `public/gallery.php` — Gallery (set list + set detail pages)
- `public/about.php`, `public/history.php`, `public/contribute.php` — content pages

## Sets / images
All set folders live under:
- `public/plates/<set_code>/`

Example:
- `public/plates/c38g/`
- `public/plates/m86p/`

Optional per-set content:
- `public/plates/<set_code>/info.php`
- `public/plates/<set_code>/varieties.php`

## Local run
From repo root:
```bash
php -S localhost:8000 -t public
