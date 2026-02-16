# Troubleshooting

## Gallery shows no sets enabled
- Verify `public/plates/` exists.
- Verify at least one set folder exists under `public/plates/`.
- Verify the folder code in `$folderMap` matches the folder name exactly.

## Thumbnails don’t show
- Confirm images are inside `public/plates/<code>/`.
- Confirm file names end in `a.<ext>` (example: `...a.png`).
- Confirm file permissions allow reading.

## Hover doesn’t flip to back
- Confirm a matching `b` image exists.
- Naming must match the base exactly except the last letter.

## Modal doesn’t open
- Confirm the modal markup exists on set pages.
- Confirm `inc/modal_script.php` is included on set pages.
- Check browser console for JS errors.

## Header size shifts between pages
- Confirm `html { overflow-y: scroll; }` exists in `main.css`.
- Hard refresh browser cache (Ctrl+F5).
