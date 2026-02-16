# Deployment

## Live structure (expected)
Web root should contain:
- `index.php`, `gallery.php`, `about.php`, `history.php`, `contribute.php`
- `main.css`
- `inc/`
- `plates/`

Set assets live under:
- `/plates/<set_code>/`

## Safe release approach
- Prefer adding new pages as `*_test.php` first.
- When replacing critical pages, rename old file first:
    - `gallery.php` -> `gallery_old.php` (temporary backup)
- Avoid touching `main.css` unless necessary; keep class names stable.

## After moving set folders
If set folders were moved from root to `/plates/`, ensure:
- `gallery.php` references `/plates/<code>/` for scanning and URLs.
- Optional `info.php` / `varieties.php` are also under `/plates/<code>/`.
