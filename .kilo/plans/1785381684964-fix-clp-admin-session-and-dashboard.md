# Plan: Fix CLP Admin Dashboard Access and centers_form.php Issue

## Problem Statement
After login, the CLP Admin dashboard is inaccessible. The related page `centers_form.php?id=30` also fails. Investigation reveals this is caused by a session persistence failure between the custom CLP admin panel and Moodle's session handler.

## Investigation Summary

### What was found
1. **Previous broken changes**: The working tree already contains modifications that introduced `moodle_bootstrap.php` and rewrote `auth.php`/`functions.php` to load Moodle and use `$DB`. These changes replaced working raw mysqli code with Moodle DB API calls.

2. **Historical fatal errors** (already fixed by current files):
   - `moodle_bootstrap.php` was missing (errors stopped after it was created at 05:02 AM)
   - Old `mysqli` code in `centers_form.php` referenced missing tables with wrong names
   - These are visible in `moodle-clp-error.log` from 04:06–04:17

3. **Current state from access logs** (`moodle-clp-access.log`):
   - `POST /clp-admin/login.php` → `302` (success)
   - `GET /clp-admin/dashboard.php` → `200 26061` (works immediately after login)
   - `GET /clp-admin/dashboard.php` (refresh) → `200 26061` (works)
   - `GET /clp-admin/centers.php` → `200 26121` (works)
   - `GET /clp-admin/centers_form.php?id=30` → `302` (redirects, likely to login)
   - `GET /clp-admin/login.php` (later) → `200` (user ended up back on login)

4. **Session diagnosis**:
   - Auth middleware calls `session_start()` before Moodle bootstrap
   - Moodle bootstrap preserves `$_SESSION['clp_admin']` across config.php load
   - Session cookie path is `/`, which covers `/clp-admin/`
   - Session cookie domain is not explicitly set (defaults to host)
   - Redirection after login works, but subsequent navigation fails — session data is lost between requests

5. **Database verification**:
   - `clp_*` tables exist and contain data
   - `mdl_local_centermanagement_centers` exists with correct columns including `follow_up_over_phone` and `last_follow_up_date`
   - Dashboard queries execute correctly when tested directly

## Root Cause
The custom CLP admin panel and Moodle share the same PHP session (`PHPSESSID`). The current `moodle_bootstrap.php` preserves `$_SESSION['clp_admin']` across Moodle initialization, but Moodle’s session handler (`\core\session\handler`) takes ownership of the session. On subsequent requests, Moodle may:
- Run session garbage collection
- Regenerate session IDs
- Close/rewrite session data in ways that conflict with the custom admin’s expectations

The result is that `$_SESSION['clp_admin']` is sometimes missing on later requests, causing auth checks to redirect to login and making the “dashboard inaccessible” after the initial successful load.

## Fix Plan

### Step 1: Isolate CLP admin session from Moodle session
**File**: `public/clp-admin/includes/auth.php`

Create a separate session namespace for the CLP admin panel so Moodle’s session handler cannot touch it. Use a dedicated session cookie with a unique name and restricted path.

### Step 2: Update session configuration
**File**: `public/clp-admin/includes/functions.php`

- Define a custom session name `CLP_ADMIN_SESSION_NAME = 'CLP_ADMIN_SESS'`
- Set `session.cookie_path` to `/clp-admin/`
- Set `session.cookie_domain` to match `moodle-clp.local`
- Set `session.cookie_httponly` and `session.cookie_secure` appropriately for local HTTP
- Start the custom session before any output or Moodle bootstrap

### Step 3: Ensure Moodle bootstrap does not overwrite CLP session
**File**: `public/clp-admin/moodle_bootstrap.php`

The current preservation logic (`$clp_admin_session` save/restore) is correct but should be verified to handle the case where Moodle’s session handler regenerates the session ID.

### Step 4: Fix any remaining raw SQL in dashboard and admin pages
**File**: `public/clp-admin/dashboard.php`

All queries already use `$db = clp_db_connect()` which connects to the `clp_*` tables directly. Verify no `$DB` (Moodle DB) references exist in `dashboard.php` to avoid accidental cross-usage.

### Step 5: Verify centers_form.php uses consistent DB access
**File**: `public/clp-admin/centers_form.php`

The file already uses `$DB` for centers table operations and `clp_db_connect()` for some older queries. The refactor should be completed so all DB access uses one consistent API (prefer raw `clp_db_connect()` for clp_ tables and `$DB` for mdl_ tables).

Note: The 302 response on `centers_form.php?id=30` is caused by the same session loss. Fixing the session isolation should resolve this.

### Step 6: Purge Moodle caches and test
- Run `php admin/cli/purge_caches.php` from Moodle root
- Clear browser cookies and test fresh login → dashboard flow
- Verify session persists across dashboard refresh and navigation to centers_form.php

## Validation Steps
1. Log in at `/clp-admin/login.php` with valid admin credentials
2. Confirm redirect to `/clp-admin/dashboard.php` returns HTTP 200
3. Refresh dashboard — must remain HTTP 200
4. Navigate to `/clp-admin/centers.php` — must return HTTP 200
5. Open `/clp-admin/centers_form.php?id=30` — must return HTTP 200 with record data
6. Logout and confirm session is destroyed
7. Attempt direct dashboard access while logged out — must redirect to login
8. Check Apache error log for new errors after fix

## Out of Scope
- Do NOT modify Moodle core files
- Do NOT remove authentication or weaken authorization
- Do NOT redesign the dashboard UI
- Do NOT commit or push without explicit approval
