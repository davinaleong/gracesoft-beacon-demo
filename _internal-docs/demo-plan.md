# 🚀 GraceSoft Beacon Lite — Deployable Demo Milestone Checklist

## 🧭 Guiding Constraints (Non-Negotiable)

Before anything, enforce these across all milestones:

* [x] No analytics / trackers (no GA, no cookies except session)
* [x] All data marked as **demo data**
* [x] Auto-delete after **≤ 24–48 hours** (NOT 30 days for demo)
* [x] File uploads restricted (size + type)
* [x] Clear disclaimer: *“Do not submit real sensitive information”*
* [x] Admin access protected (basic auth or seeded account)
* [x] Disable email sending (log only)

---

# 🧱 Milestone 1 — Foundation Setup (1 Day)

### Backend Setup

* [x] Laravel project initialized
* [x] SQLite or MySQL configured
* [x] UUID setup for primary keys
* [x] `submissions` table migration:

  * [x] id (uuid)
  * [x] name (nullable)
  * [x] email (nullable)
  * [x] message (text)
  * [x] file_path (nullable)
  * [x] expires_at (datetime)
  * [x] created_at

### Security Defaults

* [x] CSRF protection enabled
* [x] Validation rules scaffolded
* [x] File storage configured:

  * [x] `/storage/app/private`
  * [x] symbolic link NOT exposed

---

# 📝 Milestone 2 — Public Submission Page (Deploy-Ready UI)

## Route

* [x] `/submit`

---

## 🎨 UI Checklist (Public Page)

### 1. Hero Section

* [x] Title: **“Secure. Private. No Tracking.”**
* [x] Subtitle explaining purpose
* [x] Soft, calm UI (no aggressive CTAs)

---

### 2. Trust Banner (Core Differentiator)

* [x] Display clearly:

  * [x] “We do NOT track you”
  * [x] “Data auto-deletes within 24–48 hours”
  * [x] “Anonymous submission allowed”
  * [x] “Do NOT submit sensitive personal data (Demo Only)”
* [x] Use icons or checkmarks for clarity

---

### 3. Form UI

* [x] Name input (optional)
* [x] Email input (optional)
* [x] Message textarea (required)
* [x] File upload (optional)

---

### 4. Form UX States

* [x] Inline validation errors
* [x] Disabled submit button on submit
* [x] Loading state (“Submitting…”)
* [x] Success state page or alert:

  * [x] “Submission received”
  * [x] Show expiry time

---

### 5. Data Policy Note

* [x] Short paragraph:

  * [x] No tracking
  * [x] Temporary storage only
  * [x] Demo disclaimer

---

## 🔒 Backend Checklist

* [x] Validate inputs:

  * [x] message required
  * [x] email format if present
* [x] File upload rules:

  * [x] max size (e.g. 2MB)
  * [x] allowed types (pdf, jpg, png only)
* [x] Store file with UUID filename
* [x] Set:

```php
expires_at = now()->addHours(24);
```

---

# 🔐 Milestone 3 — Admin Authentication (Simple + Safe)

## Route

* [x] `/admin/login`

---

### UI Checklist

* [x] Minimal login form:

  * [x] email
  * [x] password
* [x] Error state (invalid login)
* [x] Clean, no branding clutter

---

### Backend Checklist

* [x] Seed demo admin account
* [x] Use Laravel auth (no roles needed)
* [x] Session-based login
* [x] Rate limit login attempts

---

# 📊 Milestone 4 — Admin Dashboard (Interactive Demo Core)

## Route

* [x] `/admin/submissions`

---

## 🎨 UI Checklist (Dashboard)

### Table View

* [x] Columns:

  * [x] ID (shortened UUID)
  * [x] Message preview (truncate)
  * [x] File indicator (icon / yes/no)
  * [x] Created at
  * [x] Expiry time

---

### UX Features

* [x] Click row → detail page
* [x] Empty state:

  * [x] “No submissions yet”
* [x] Expiry indicator:

  * [x] Red if <6 hours left
  * [x] Grey if expired

---

### Controls

* [x] Manual delete button per row
* [ ] Bulk delete (optional stretch)

---

## 🔒 Backend Checklist

* [x] Auth middleware enforced
* [x] Paginate results
* [x] Filter out expired records (or mark clearly)

---

# 📂 Milestone 5 — Submission Detail Page

## Route

* [x] `/admin/submissions/{id}`

---

## 🎨 UI Checklist

### Content Display

* [x] Full message (formatted)
* [x] Name/email (if present)
* [x] Metadata:

  * [x] Created at
  * [x] Expiry time

---

### File Handling

* [x] Download button
* [x] No direct file URL exposure

---

### Actions

* [x] Delete button
* [x] Confirmation modal:

  * [x] “This will permanently delete the submission”

---

## 🔒 Backend Checklist

* [x] Secure file route:

  * [x] `/admin/files/{id}`
  * [x] Auth check
  * [x] Stream file (no public link)

---

# ♻️ Milestone 6 — Data Lifecycle (CRITICAL for Trust Demo)

---

## Cleanup Logic

### Artisan Command

* [x] Create:

```bash
php artisan beacon:cleanup
```

* [x] Deletes:

  * [x] expired submissions
  * [x] associated files

---

### Scheduler

* [x] Run every hour

---

## UI Reinforcement

* [x] Show expiry message:

  * [x] “This record will be deleted at: …”
* [x] Expired records:

  * [x] auto-hidden OR marked clearly

---

# 🛡 Milestone 7 — Demo Safety Hardening (VERY IMPORTANT)

---

## Prevent Real Usage

* [x] Banner across app:

  * [x] “Demo Environment — Do NOT submit sensitive data”
* [x] Optional:

  * [x] Auto-generate fake sample submissions

---

## Abuse Protection

* [x] Rate limit form submissions
* [x] Honeypot field (hidden input)
* [x] File upload throttling

---

## Logging (Optional)

* [ ] Log actions (no personal data analysis)

---

# 🎨 Milestone 8 — UX Polish (Client-Ready)

---

## Visual Consistency

* [x] Typography scale (clear hierarchy)
* [x] Button styles:

  * [x] primary (submit)
  * [x] danger (delete)
* [x] Spacing system (consistent padding/margins)
* [x] Frontend form, auth pages, and admin panel share one visual system

---

## Trust-Driven UX

* [x] No dark patterns
* [x] No forced inputs
* [x] Clear language (non-technical)

---

## Responsiveness

* [x] Mobile-friendly form
* [x] Table scroll on small screens

---

# 🚀 Final Deliverable (What You’ll Have)

A **deployable Beacon Lite demo** that:

* Feels real (clients can interact)
* Demonstrates:

  * secure submissions
  * privacy-first UX
  * data lifecycle
* Avoids:

  * storing real sensitive data
  * legal/privacy risks
* Supports your pitch:

> “We don’t collect more data — we protect what you already have.”
