# CopperCoins 3.0 – Scheduled Jobs Policy

## Purpose
This document defines the intent and responsibilities of automated background jobs used to maintain catalog integrity and enforce system policies.

Scheduled jobs must operate predictably, conservatively, and transparently.

---

## Daily Tombstone Release Job

### Job Intent
The Daily Tombstone Release Job exists to automatically release die numbers that have completed their six-month tombstone reservation period, making them eligible for reassignment.

This job ensures:
- consistent enforcement of the tombstone policy
- elimination of manual oversight
- predictable die number availability

---

### Execution Frequency
- The job must run **once per day**.
- The exact execution time may be configured but must remain consistent.

---

### Conditions Checked
On each run, the job must identify die numbers that:

- are marked as `reserved_unassigned` (tombstone status), and
- have a reservation expiration date that is **less than or equal to the current date/time**.

---

### Actions Performed
For each qualifying die number, the job must:

1. Change the status to `available_unassigned`
2. Clear or finalize the reservation expiration marker
3. Record a catalog change event indicating the release

The job must not assign die numbers directly.

---

### Logging and Audit
- Each release action must generate a catalog change log entry.
- Job execution results (success/failure counts) should be logged for administrative review.
- Failures must not partially process records.

---

## Safety Constraints

- The job must never override active reservations.
- The job must never skip change log creation.
- The job must not modify assigned die numbers.
- The job must be idempotent (safe to re-run without side effects).

---

## Administrative Overrides
If manual release or reassignment is ever permitted:
- it must require explicit admin confirmation
- it must generate a catalog change event
- it must not bypass the lowest-available assignment rule

Scheduled jobs exist to enforce policy, not to replace administrative judgment.
