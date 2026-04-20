# 🧭 1. Strategy: What This “Simulated Product” Is

This is NOT:

> a full CMS

This IS:

> a **“Beacon Demo App”** — a thin, believable layer that demonstrates:

* Secure forms
* Privacy-first messaging
* Admin handling sensitive data
* Data lifecycle (delete/expire)

👉 Think of it as:

> **“Beacon Lite (Proof of Trust)”**

---

# 🧱 2. Simplest Tech Stack (Speed > Purity)

You want **maximum speed, minimum thinking overhead**:

### ✅ Recommended Stack

* **Laravel (monolith, no modules yet)**
* Blade (no React, no Livewire for now)
* SQLite (or MySQL if already set up)
* Local file storage (but structured securely)
* Tailwind (optional, or just simple CSS)

👉 Why:

* You already know Laravel deeply
* No context switching
* Fastest path to something demo-able

---

# 🧩 3. The Demo Concept (What You’re “Selling”)

## 🎯 Demo Product Name Ideas

* Beacon Demo
* Beacon Trust Portal
* GraceSoft Beacon Lite
* “Secure Submission Portal”

---

## 💡 Core Demo Story

> “This is how an organisation can safely collect sensitive data without tracking users.”

Tie it directly to your deck:

> “A CMS that protects your community” 

---

# 🧪 4. Demo Features (Keep It VERY Focused)

## 🔹 Public Side (1 Page Only)

### 📝 Secure Form Page

Fields:

* Name (optional)
* Email (optional)
* Message (required)
* File upload (optional)

### 🧠 Trust UX (VERY IMPORTANT)

This is your differentiator:

Display clearly:

* ✅ “We do NOT track you”
* ✅ “Your data will be deleted in 30 days”
* ✅ “You may submit anonymously”
* ✅ “Files are stored securely and not publicly accessible”

👉 This directly addresses gaps you identified:

* weak form security
* lack of transparency 

---

## 🔹 Admin Side (1–2 Pages Only)

### 🔐 Admin Login (basic)

### 📊 Submissions Dashboard

Table:

* ID (UUID)
* Message preview
* Has file? (yes/no)
* Created at
* Expiry date

### 📂 View Submission

* Full message
* Download file (via secure route)
* Delete button

---

# 🔐 5. “Fake but Real” Security Layer

Even though it’s a demo, it must FEEL legit.

## ✅ Do This

### File Upload

* store in `/storage/app/private`
* random filename (UUID)
* NEVER expose direct URL

### File Access

* `/admin/files/{id}` route
* check admin auth
* stream file

---

### Data Lifecycle (Simple Version)

* Add column: `expires_at`
* Set:

```php
now()->addDays(30)
```

* Show in UI:

> “This data will be deleted on…”

---

### Optional (Nice Touch)

Create command:

```bash
php artisan beacon:cleanup
```

Deletes expired records

👉 This reinforces your:

> “Data lifecycle” concept 

---

# 🗂 6. Minimal Database Design

### `submissions`

* id (uuid)
* name (nullable)
* email (nullable)
* message (text)
* file_path (nullable)
* expires_at (datetime)
* created_at

---

# 🖥 7. UI Structure (Super Lean)

## Public

```
/submit
```

Sections:

1. Hero:
   “Secure. Private. No Tracking.”
2. Trust statements
3. Form
4. Data policy note

---

## Admin

```
/admin/login
/admin/submissions
/admin/submissions/{id}
```

---

# 🎨 8. UX Tone (VERY IMPORTANT)

Match your positioning:

From your doc:

> “Privacy-first, modular, trust-driven infrastructure” 

So your UI should feel:

* Calm
* Clear
* No dark patterns
* No “growth hacking”

---

# ⚡ 9. What You SHOULD NOT Build (Yet)

Avoid overengineering:

❌ Modules system
❌ GraphQL
❌ Multi-tenancy
❌ Roles/permissions complexity
❌ Notifications
❌ Analytics

👉 That’s Core + Services later

---

# 🧭 10. How This Buys You Time (Strategically)

This demo lets you:

### 1. Show something real

Instead of slides only

### 2. Validate messaging

Do people respond to:

* “No tracking”
* “Auto-delete”

### 3. Start conversations

You can say:

> “This is a simplified version of Beacon — the full system is modular and enterprise-ready.”

---

# 🧩 11. Positioning Script (Use This When Showing)

You can literally say:

> “Most systems focus on collecting more data.
> Beacon focuses on **protecting the data you already have.**”

---

# 🚀 12. Optional Next Step (If You Want)

I can help you:

* Draft the **actual Blade UI (copy + layout)**
* Generate:

  * Controller
  * Migration
  * Routes
  * File upload logic
* OR simulate the **admin panel UI like HQ style**
