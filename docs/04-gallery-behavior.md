# Gallery behavior

## Main routes
- Gallery landing:
    - `/gallery.php`
- Set detail:
    - `/gallery.php?year=<urlencoded set label>`

## What happens on gallery landing
- Shows all sets in `$folderMap`
- Each set is enabled if:
    - the folder exists under `public/plates/<code>/`
    - AND at least one `*a.<ext>` image exists
- Thumbnail is the first matching `a` image found by scan order.

## What happens on a set detail page
- Includes `info.php` if present:
    - `public/plates/<code>/info.php`
- Scans the set folder for `a` images and pairs with `b` if present.
- Renders thumbnails with:
    - `data-hover` for b image (if found)
    - `data-original` for a image
- Modal opens on click and forces the `a` side.

## Extensions supported
- jpg, jpeg, png, gif, webp, bmp

## Troubleshooting quick hits
- No thumbnails:
    - folder missing under `public/plates/`
    - file naming not ending in `a.<ext>`
- Hover not flipping:
    - matching `b.<ext>` missing
