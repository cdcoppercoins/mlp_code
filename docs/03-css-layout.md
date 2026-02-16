# CSS & layout rules

## One stylesheet
All styling must live in:
- `public/main.css`

No additional stylesheets should be added on a per-page basis.

## Critical layout classes (do not rename)
The site layout depends on these classes; changing them can break alignment:

- `content-wrapper`
- `set-width`
- `set-list`
- `set-box`
- `set-thumb`
- `set-label`
- `image-container`
- `thumb-img`
- `modal`, `modal-close`

## Scrollbar stability
To keep header sizing stable across short/long pages, the site uses:
- `html { overflow-y: scroll; }`

This prevents small width shifts when scrollbars appear/disappear.
