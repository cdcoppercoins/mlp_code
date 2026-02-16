# Architecture

## Page shell (enforces shared layout)
All public pages include the shared shell:

- Start of page:
    - `public/inc/page_top.php`
        - outputs doctype + `<head>`
        - loads `main.css`
        - includes `header.php`
        - opens `<div class="content-wrapper">`

- End of page:
    - `public/inc/page_bottom.php`
        - closes `.content-wrapper`
        - includes `footer.php`
        - closes body/html

This guarantees:
- one stylesheet
- one header/footer
- consistent wrapper markup across all pages

## Modal behavior
- Gallery pages include a modal div with id `imageModal` and `modalImg`.
- The click-to-open behavior is provided by:
    - `public/inc/modal_script.php`

## Public directory layout
`public/` contains everything served by the web server:
- PHP pages
- CSS
- includes
- `plates/` assets directory
