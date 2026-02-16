# Sets and folders

## Folder location
All set folders are stored under:
- `public/plates/<set_code>/`

Examples:
- `public/plates/c36g/`
- `public/plates/m78p/`

## Folder map
`public/gallery.php` contains `$folderMap`:
- key: the display label (shown to users and used in the `year` querystring)
- value: folder code (the folder name under `plates/`)

Example pattern:
- `'1968 Post Cereal Plates' => 'm68p',`

## Image naming convention
The gallery finds "front" images using the `a` suffix.
Typical file pairs:
- `something...a.jpg`  (front)
- `something...b.jpg`  (back)

If the back image exists, hover swaps to the `b` image.

## Optional per-set content files
Inside each set folder:
- `info.php` (top-of-set content area; should include a "Gallery Home" link)
- `varieties.php` (content shown after the image grid)

These files are optional; the gallery checks existence before including.
