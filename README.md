# GraceSoft Beacon Lite

GraceSoft Beacon Lite is a privacy-first demo app for secure intake messages.

It is designed for client demonstrations where teams need to show:

- Temporary message submission with optional attachment
- Admin-only review and download flow
- Automatic lifecycle cleanup for retained demo data
- Clear trust language with no analytics tracking behavior

## Tech Stack

- Laravel 13
- PHP 8.5
- Tailwind CSS 4
- Pest 4

## Main Flows

### Public Submission

- URL: /submit
- Optional fields: name, email
- Required field: message
- Optional file upload: pdf, jpg, jpeg, png up to 2 MB
- Honeypot field enabled to reduce spam
- Submission route is rate limited

### Admin Access

- Login URL: /admin/login
- Dashboard URL: /admin/submissions
- Detail URL: /admin/submissions/{submission}
- File download URL: /admin/files/{submission}

Demo seeded account:

- Email: admin@beacon-demo.test
- Password: password

## Data Retention

Retention is configurable for meeting demos.

- Environment variable: DEMO_RETENTION_MINUTES
- Default: 1440 (24 hours)
- Config source: [config/beacon.php](config/beacon.php)
- Expiry assignment on create: [app/Http/Controllers/SubmissionController.php](app/Http/Controllers/SubmissionController.php)
- Cleanup command: [app/Console/Commands/BeaconCleanupCommand.php](app/Console/Commands/BeaconCleanupCommand.php)
- Scheduler: [routes/console.php](routes/console.php)

Important behavior:

- New submissions use the current retention value when created.
- Existing rows keep their already stored expires_at timestamp.

## Quick Start

1. Install dependencies
	- composer install
	- npm install

2. Environment setup
	- copy .env.example to .env
	- set DB credentials
	- set DEMO_RETENTION_MINUTES as needed for your demo

3. App key and database
	- php artisan key:generate
	- php artisan migrate --seed

4. Frontend assets
	- npm run dev

5. Run app
	- php artisan serve

## Useful Commands

- Run tests:
  - php artisan test --compact

- Run cleanup now:
  - php artisan beacon:cleanup

- If config is cached and .env was changed:
  - php artisan config:clear

## Rate Limits

Configured in [app/Providers/AppServiceProvider.php](app/Providers/AppServiceProvider.php):

- submission: 5 requests per minute per IP
- admin-login: 5 requests per minute per IP

## Notes For Demo Operators

- The app is intended for demo data only.
- Do not submit sensitive personal information.
- The UI displays current retention language based on config.
