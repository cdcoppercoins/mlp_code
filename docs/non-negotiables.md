Purpose:
 Defines what must always be true, regardless of implementation.
Contains:
Tombstone window = 6 months
Lowest-available assignment rule
Change log must exist and be visible
Merge capability must exist
Does NOT contain:
SQL
cron syntax
UI button labels
code details
Think of this as: “If this changes, stop and rethink the project.”

# CopperCoins 3.0 – Non-Negotiables

## Die Number Corrections, Tombstones, and Reassignment

- **Merge capability:** Admins must be able to merge a mistakenly assigned die number into a canonical die number from the admin panel.

- **Tombstone window (6 months):** When a die number is merged into a canonical die, that die number becomes an **unassigned tombstone reference** for **6 months**. During this period, the tombstone page must remain accessible and must include a clear link to the canonical die number.

- **Change log visibility:** A dynamic **Catalog Change Log** must exist. A link to this change log must appear:
  - on the home page, and
  - on every tombstone/reassigned die number page.

- **Change log export:** Collectors must be able to **download and/or print a PDF** copy of the Catalog Change Log.

- **Automatic daily release job:** Tombstone die numbers must be released automatically by a scheduled job that runs **daily**. When the 6-month window expires, the die number becomes available for reassignment according to the rules below.

- **Lowest-available assignment rule:** Any time a die number is assigned (including reassignment after tombstone release), the system must use the **lowest available index number** within the applicable group (year/mint/denomination/die type/proof).

- Existing die references must never break
- Visitors cannot access full die detail pages
- Members always can
- Admin CMS must support partial publishing
- Image storage must not depend on local disk long-term
- Old CopperCoins site remains untouched until final cutover
