# Decision Log

- 2026-02-16: Implemented shared page shell includes (`inc/page_top.php`, `inc/page_bottom.php`) to force one header/footer and one CSS layout across all pages.
- 2026-02-16: Split site into `index.php` (home/intro) and `gallery.php` (gallery + set detail).
- 2026-02-16: Added `html { overflow-y: scroll; }` to prevent header width/size shift between short and long pages.
- 2026-02-16: Switched site font to Nunito via Google Fonts import.
- 2026-02-16: Plan/structure updated to store all set folders and images under `/plates/` instead of site root.
