# Scheduled Job: Daily Tombstone Release

## Purpose
Automatically releases die numbers in tombstone status after the reservation period expires (policy: 6 months).

## Command
- `php artisan coppercoins:release-tombstones`
- Dry run: `php artisan coppercoins:release-tombstones --dry-run`

## What it does
- Finds die_numbers where:
  - status = reserved_unassigned
  - reserved_until <= now
- Sets them to:
  - status = available_unassigned
  - reserved_until = NULL
- Inserts a catalog_change_events entry for each release:
  - event_type = release_reserved_number
  - admin_user_id = NULL (system)

## Scheduling
Configured in `app/Console/Kernel.php` to run daily.

## Cron requirement
Laravel scheduler requires a system cron entry:
`* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`
(Exact server path will be set after deployment.)
