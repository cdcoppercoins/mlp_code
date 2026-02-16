# CopperCoins 3.0 – Die Number Policy

## Purpose
This document defines how die numbers are assigned, corrected, merged, reserved, and reused within the CopperCoins Die System.  
Its goal is to preserve long-standing collector expectations while allowing for accurate correction of mistakes and responsible catalog maintenance.

This policy governs **behavior**, not implementation details.

---

## Core Principles

1. **Continuity**
   - Public die numbering must remain sequential and gap-free.
   - Collectors expect die numbers to exist in continuous order without unexplained breaks.

2. **Transparency**
   - All corrections, merges, releases, and reassignments must be visible through a public-facing change log.
   - Silent or hidden changes are not permitted.

3. **Correctability**
   - Human error is expected in attribution work.
   - The system must allow mistaken assignments to be corrected without damaging catalog integrity.

4. **Minimal Disruption**
   - Corrections should preserve usability for collectors referencing historical material, articles, or saved research.

---

## Die Number Assignment

- Die numbers are assigned only after a die has been verified as distinct.
- When assigning a die number, the system must always select the **lowest available index number** within the applicable group:
  - Year
  - Mint
  - Denomination
  - Die type
  - Proof status

“Available” means:
- the die number is unassigned, and
- it is not currently reserved as a tombstone, or its reservation period has expired.

---

## Mistaken Assignments and Merges

If a die number is mistakenly assigned to a die that is later determined to already exist in the catalog:

1. The mistaken die number must be **merged** into the correct (canonical) die.
2. The mistaken die number becomes an **unassigned tombstone reference**.
3. The tombstone page must remain publicly accessible and must clearly link to the canonical die number.
4. A catalog change event must be recorded and displayed in the change log.

The mistaken die number is **not deleted** and does not disappear from the sequence.

---

## Tombstone Reservation Period

- Tombstone die numbers remain **reserved and unassignable for six (6) months** from the date of merge.
- During this period:
  - the die number page remains accessible,
  - the canonical die is clearly identified,
  - the change log is prominently linked.

This reservation period allows collectors time to discover and understand catalog corrections before reassignment occurs.

---

## Automatic Release and Reassignment

- A scheduled system job runs **daily** to identify tombstone die numbers whose reservation period has expired.
- When the reservation expires:
  - the die number becomes available for reassignment,
  - it re-enters the pool of assignable numbers.
- When reassigned, the system must again use the **lowest available index number** rule.

All releases and reassignments must generate catalog change events.

---

## Catalog Change Log

- All die number merges, releases, and reassignments must be recorded as immutable catalog change events.
- The Catalog Change Log must be accessible:
  - from the home page, and
  - from every tombstone or reassigned die number page.
- Collectors must be able to:
  - view recent and historical changes, and
  - download or print a PDF copy of the change log.

---

## Collector Experience

Collectors should expect that:
- die numbers remain sequential and discoverable,
- corrected numbers are explained, not hidden,
- reassigned numbers follow a clear, documented process,
- the catalog reflects both accuracy and historical accountability.

This policy exists to maintain trust in CopperCoins as a long-term reference system.

