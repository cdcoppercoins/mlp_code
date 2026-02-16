# AI Context Brief

Project: MiniLicensePlates.com

Rules:
- Do not change visual layout appearance unless explicitly requested.
- All public pages must use `public/inc/page_top.php` + `page_bottom.php`.
- Use only `public/main.css` for styling (one stylesheet).
- Set folders live under `public/plates/<set_code>/`.
- Gallery behavior lives in `public/gallery.php` and uses `$folderMap`.
- Optional per-set content files:
    - `public/plates/<set_code>/info.php`
    - `public/plates/<set_code>/varieties.php`

High-risk areas:
- CSS class renames
- moving wrapper divs (`content-wrapper`, `set-width`)
- changing gallery file naming expectations (a/b)
