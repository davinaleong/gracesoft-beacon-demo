# 🚀 GraceSoft Beacon Lite — Deployable Demo Milestone Checklist

## 🧭 Guiding Constraints (Non-Negotiable)

Before anything, enforce these across all milestones:

* [ ] No analytics / trackers (no GA, no cookies except session)
* [ ] All data marked as **demo data**
* [ ] Auto-delete after **≤ 24–48 hours** (NOT 30 days for demo)
* [ ] File uploads restricted (size + type)
* [ ] Clear disclaimer: *“Do not submit real sensitive information”*
* [ ] Admin access protected (basic auth or seeded account)
* [ ] Disable email sending (log only)

---

# 🧱 Milestone 1 — Foundation Setup (1 Day)

### Backend Setup

* [ ] Laravel project initialized
* [ ] SQLite or MySQL configured
* [ ] UUID setup for primary keys
* [ ] `submissions` table migration:

  * [ ] id (uuid)
  * [ ] name (nullable)
  * [ ] email (nullable)
  * [ ] message (text)
  * [ ] file_path (nullable)
  * [ ] expires_at (datetime)
  * [ ] created_at

### Security Defaults

* [ ] CSRF protection enabled
* [ ] Validation rules scaffolded
* [ ] File storage configured:

  * [ ] `/storage/app/private`
  * [ ] symbolic link NOT exposed

---

# 📝 Milestone 2 — Public Submission Page (Deploy-Ready UI)

## Route

* [ ] `/submit`

---

## 🎨 UI Checklist (Public Page)

### 1. Hero Section

* [ ] Title: **“Secure. Private. No Tracking.”**
* [ ] Subtitle explaining purpose
* [ ] Soft, calm UI (no aggressive CTAs)

---

### 2. Trust Banner (Core Differentiator)

* [ ] Display clearly:

  * [ ] “We do NOT track you”
  * [ ] “Data auto-deletes within 24–48 hours”
  * [ ] “Anonymous submission allowed”
  * [ ] “Do NOT submit sensitive personal data (Demo Only)”
* [ ] Use icons or checkmarks for clarity

---

### 3. Form UI

* [ ] Name input (optional)
* [ ] Email input (optional)
* [ ] Message textarea (required)
* [ ] File upload (optional)

---

### 4. Form UX States

* [ ] Inline validation errors
* [ ] Disabled submit button on submit
* [ ] Loading state (“Submitting…”)
* [ ] Success state page or alert:

  * [ ] “Submission received”
  * [ ] Show expiry time

---

### 5. Data Policy Note

* [ ] Short paragraph:

  * [ ] No tracking
  * [ ] Temporary storage only
  * [ ] Demo disclaimer

---

## 🔒 Backend Checklist

* [ ] Validate inputs:

  * [ ] message required
  * [ ] email format if present
* [ ] File upload rules:

  * [ ] max size (e.g. 2MB)
  * [ ] allowed types (pdf, jpg, png only)
* [ ] Store file with UUID filename
* [ ] Set:

```php
expires_at = now()->addHours(24);
```

---

# 🔐 Milestone 3 — Admin Authentication (Simple + Safe)

## Route

* [ ] `/admin/login`

---

### UI Checklist

* [ ] Minimal login form:

  * [ ] email
  * [ ] password
* [ ] Error state (invalid login)
* [ ] Clean, no branding clutter

---

### Backend Checklist

* [ ] Seed demo admin account
* [ ] Use Laravel auth (no roles needed)
* [ ] Session-based login
* [ ] Rate limit login attempts

---

# 📊 Milestone 4 — Admin Dashboard (Interactive Demo Core)

## Route

* [ ] `/admin/submissions`

---

## 🎨 UI Checklist (Dashboard)

### Table View

* [ ] Columns:

  * [ ] ID (shortened UUID)
  * [ ] Message preview (truncate)
  * [ ] File indicator (icon / yes/no)
  * [ ] Created at
  * [ ] Expiry time

---

### UX Features

* [ ] Click row → detail page
* [ ] Empty state:

  * [ ] “No submissions yet”
* [ ] Expiry indicator:

  * [ ] Red if <6 hours left
  * [ ] Grey if expired

---

### Controls

* [ ] Manual delete button per row
* [ ] Bulk delete (optional stretch)

---

## 🔒 Backend Checklist

* [ ] Auth middleware enforced
* [ ] Paginate results
* [ ] Filter out expired records (or mark clearly)

---

# 📂 Milestone 5 — Submission Detail Page

## Route

* [ ] `/admin/submissions/{id}`

---

## 🎨 UI Checklist

### Content Display

* [ ] Full message (formatted)
* [ ] Name/email (if present)
* [ ] Metadata:

  * [ ] Created at
  * [ ] Expiry time

---

### File Handling

* [ ] Download button
* [ ] No direct file URL exposure

---

### Actions

* [ ] Delete button
* [ ] Confirmation modal:

  * [ ] “This will permanently delete the submission”

---

## 🔒 Backend Checklist

* [ ] Secure file route:

  * [ ] `/admin/files/{id}`
  * [ ] Auth check
  * [ ] Stream file (no public link)

---

# ♻️ Milestone 6 — Data Lifecycle (CRITICAL for Trust Demo)

---

## Cleanup Logic

### Artisan Command

* [ ] Create:

```bash
php artisan beacon:cleanup
```

* [ ] Deletes:

  * [ ] expired submissions
  * [ ] associated files

---

### Scheduler

* [ ] Run every hour

---

## UI Reinforcement

* [ ] Show expiry message:

  * [ ] “This record will be deleted at: …”
* [ ] Expired records:

  * [ ] auto-hidden OR marked clearly

---

# 🛡 Milestone 7 — Demo Safety Hardening (VERY IMPORTANT)

---

## Prevent Real Usage

* [ ] Banner across app:

  * [ ] “Demo Environment — Do NOT submit sensitive data”
* [ ] Optional:

  * [ ] Auto-generate fake sample submissions

---

## Abuse Protection

* [ ] Rate limit form submissions
* [ ] Honeypot field (hidden input)
* [ ] File upload throttling

---

## Logging (Optional)

* [ ] Log actions (no personal data analysis)

---

# 🎨 Milestone 8 — UX Polish (Client-Ready)

---

## Visual Consistency

* [ ] Typography scale (clear hierarchy)
* [ ] Button styles:

  * [ ] primary (submit)
  * [ ] danger (delete)
* [ ] Spacing system (consistent padding/margins)

---

## Trust-Driven UX

* [ ] No dark patterns
* [ ] No forced inputs
* [ ] Clear language (non-technical)

---

## Responsiveness

* [ ] Mobile-friendly form
* [ ] Table scroll on small screens

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
