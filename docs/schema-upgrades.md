# CopperCoins 3.0 – Schema Upgrade Notes

## Future Upgrade: Link catalog_change_events.admin_user_id to users.id

### Current State
`catalog_change_events.admin_user_id` is intentionally stored as a nullable unsigned bigint without a foreign key.

Reason:
- The `users` table schema (and admin identity model) will evolve during early development.
- System-generated events (e.g., daily tombstone release job) should be allowed with `admin_user_id = NULL`.

### Upgrade Goal
After the authentication/user system is finalized, upgrade `catalog_change_events.admin_user_id` to a nullable foreign key referencing `users.id`.

Recommended delete behavior:
- `SET NULL` on user deletion, to preserve historical change events.

### Implementation Plan (Laravel migration)
Create a new migration that:
1. Ensures existing `admin_user_id` values correspond to valid users (or sets invalid values to NULL).
2. Adds the foreign key constraint.

Example (conceptual):
- add FK: `catalog_change_events.admin_user_id` → `users.id` ON DELETE SET NULL
