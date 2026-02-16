# CopperCoins 3.0 – Admin Workflows

## Purpose
This document defines the **intended administrative workflows** used to maintain accuracy, continuity, and transparency within the CopperCoins Die System.

It describes *what* administrators must be able to do and *what safeguards must exist*, without prescribing UI layouts or technical implementation.

---

## Administrative Principles

- Administrative actions must favor **catalog integrity over convenience**.
- All material catalog changes must be **intentional, explainable, and traceable**.
- No administrative action that affects public die numbering may occur without a recorded reason.
- Admin tools exist to correct errors, not to obscure them.

---

## Core Admin Roles and Permissions

Only authorized administrators may perform the workflows described in this document.

Administrative permissions must ensure that:
- destructive or irreversible actions require explicit confirmation,
- catalog-altering actions require a reason to be recorded,
- all actions are attributable to a specific admin user.

---

## Workflow: Merge Mistaken Die Number into Canonical Die

### Use Case
An admin discovers that a die number was mistakenly assigned to a die that already exists in the catalog.

### Required Admin Inputs
- Mistaken die number
- Canonical die number
- Reason for merge (required, human-readable)

### System Behavior
Upon confirmation:
1. The mistaken die number is merged into the canonical die.
2. The mistaken die number becomes an **unassigned tombstone reference**.
3. A six-month reservation period begins for the tombstone.
4. A catalog change event is recorded.
5. The tombstone die number page remains publicly accessible and links to the canonical die.
6. The Catalog Change Log link is displayed on the tombstone page.

This action must not delete records or silently alter numbering.

---

## Workflow: View and Manage Tombstone Die Numbers

### Use Case
Admins need visibility into die numbers currently in tombstone status.

### Admin Capabilities
Admins must be able to:
- view all active tombstone die numbers,
- see reservation start and expiration dates,
- see the canonical die associated with each tombstone,
- view the catalog change history related to the tombstone.

Manual reassignment during the reservation period should be restricted or require elevated confirmation and justification.

---

## Workflow: Assign Die Number to New Die

### Use Case
An admin verifies a newly discovered die and assigns a public die number.

### Assignment Rules
- The system must automatically select the **lowest available index number** within the applicable group:
  - year
  - mint
  - denomination
  - die type
  - proof status
- Admins must not manually override numbering order except through explicitly defined administrative override mechanisms.

### System Behavior
Upon assignment:
- the selected die number is assigned to the die,
- the assignment is logged as a catalog change event,
- the die becomes publicly accessible under its assigned number.

---

## Workflow: Reassign Released Tombstone Die Number

### Use Case
A tombstone die number has completed its six-month reservation period and becomes eligible for reuse.

### Admin Capabilities
Admins must be able to:
- assign a released die number to a new die,
- provide a reason for reassignment,
- view the prior history of that die number.

### System Behavior
Upon reassignment:
- the die number becomes assigned to the new die,
- the reassignment is recorded in the Catalog Change Log,
- the die number page reflects its new assignment with historical context preserved.

---

## Workflow: View Catalog Change Log

### Use Case
Admins review recent or historical catalog changes.

### Admin Capabilities
Admins must be able to:
- view all catalog change events,
- filter by date range or die number,
- inspect the reason and admin responsible for each change,
- verify public visibility of change log entries.

Admins must not be able to delete or alter existing change log entries.

---

## Confirmation and Safeguards

For any action that affects public die numbering:
- a confirmation step must be required,
- the consequences of the action must be clearly stated,
- a reason field must be mandatory.

Where appropriate, irreversible actions should require a secondary confirmation step.

---

## Audit and Accountability

- Every catalog-altering admin action must be attributable to a specific admin user.
- All actions must be timestamped.
- Administrative activity must be auditable through the Catalog Change Log.

Admin workflows are designed to preserve long-term trust in CopperCoins as a reference authority.
