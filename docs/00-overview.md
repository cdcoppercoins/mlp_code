
---

## `docs/00-overview.md`
```md
# Overview

This project is the codebase for MiniLicensePlates.com.

## What the site does
- Shows a gallery of miniature license plate premium sets, grouped by issue/year label.
- Each set displays thumbnails and supports:
    - hover flip (front "a" -> back "b" when present)
    - click-to-open modal showing the front side

## How content is organized
- Each set has a folder code (e.g. `m68p`) stored in `/public/plates/`.
- `gallery.php` contains a `$folderMap` from human label -> folder code.
- Some sets have optional content files:
    - `info.php` (intro text + "Gallery Home" button)
    - `varieties.php` (extra notes/listing under the thumbnails)

## What to edit most often
- Adding/changing sets: `public/gallery.php` `$folderMap`
- Styling: `public/main.css` (single stylesheet)
- Header/nav: `public/header.php`
- Footer: `public/footer.php`
- Page shell: `public/inc/page_top.php`, `public/inc/page_bottom.php`
