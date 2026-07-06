# Software Requirements Specification (SRS)
## Porto (Laravel 12 Portfolio) — Security & Infrastructure Improvements

**Version:** 1.0  
**Date:** 6 Juli 2026  
**Target Audience:** Backend Engineers, DevOps Engineers, QA Engineers

---

## 1. Document Overview

Dokumen ini mendefinisikan **detailed functional dan non-functional requirements** untuk mengimplementasikan security fixes dan infrastructure improvements pada Porto (Laravel 12 portfolio).

Setiap requirement dipecah menjadi:
- **Functional Requirement (FR):** Apa yang system harus lakukan
- **Non-Functional Requirement (NFR):** Quality attributes (performance, security, reliability)
- **Acceptance Criteria:** Concrete test cases untuk verify completion

---

## 2. Functional Requirements

### 2.1 Authentication & Authorization

#### FR-AUTH-01: Disable Public Admin Registration

**Description:**  
Aplikasi harus menonaktifkan akses publik ke admin registration endpoint. Hanya administrator yang sudah ada atau developer yang authorized bisa membuat akun admin baru.

**Current State (Problematic):**
```php
// routes/admin.php
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('admin.register');  // ❌ OPEN
    Route::post('/register', [AuthController::class, 'register']);  // ❌ OPEN
});
```

**Desired State:**
```php
// routes/admin.php
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    // Register routes removed or protected
});
```

**Implementation Details:**

**Option A: Complete Removal (Recommended for MVP)**
- [ ] Delete `GET /admin/register` route
- [ ] Delete `POST /admin/register` route
- [ ] Delete "Register here" link from `resources/views/admin/auth/login.blade.php`
- [ ] Create admin accounts via: `php artisan tinker` or seeder

**Option B: Environment-Gated (Future Flexibility)**
```php
Route::middleware(['guest'])->group(function () {
    if (config('app.allow_admin_registration', false)) {
        Route::get('/register', [AuthController::class, 'showRegister'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'register']);
    }
    // login routes...
});

// In .env
ALLOW_ADMIN_REGISTRATION=false

// In config/app.php
'allow_admin_registration' => env('ALLOW_ADMIN_REGISTRATION', false),
```

**Option C: Invite-Only (More Robust)**
```php
// Generate invite token via: php artisan admin:invite email@example.com
// Route protected by middleware that validates token
Route::get('/register/{token}', [AuthController::class, 'showRegister'])
    ->middleware('validate.invite.token')
    ->name('admin.register');
```

**Acceptance Criteria:**
- [ ] GET `/admin/register` returns 404 (or redirects to login)
- [ ] POST `/admin/register` returns 404 (or 403 Forbidden)
- [ ] Admin login page HTML does NOT contain "Register here" link
- [ ] Admin panel only accessible after login with valid credentials
- [ ] Existing admin accounts work normally after change
- [ ] No broken routes in `php artisan route:list`

**Testing:**
```php
// tests/Feature/AuthTest.php
public function test_admin_registration_disabled()
{
    $response = $this->get('/admin/register');
    $this->assertEquals(404, $response->status());
}

public function test_admin_register_post_forbidden()
{
    $response = $this->post('/admin/register', ['email' => 'new@test.com', 'password' => 'pass']);
    $this->assertEquals(404, $response->status());
}

public function test_admin_login_shows_no_register_link()
{
    $response = $this->get('/admin/login');
    $this->assertStringNotContainsString('Register here', $response->getContent());
}
```

---

#### FR-AUTH-02: Rate Limiting on Admin Login

**Description:**  
API endpoint `POST /admin/login` harus membatasi jumlah login attempts untuk mencegah brute force attack.

**Requirements:**
- Max 5 failed login attempts per minute per IP address
- After limit exceeded: return HTTP 429 (Too Many Requests)
- Display user-friendly error message
- Rate limit counter reset setiap menit

**Implementation:**

**Option A: Middleware (Recommended)**
```php
// routes/admin.php
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')  // 5 req per 1 minute
    ->name('admin.login');
```

**Option B: Custom Middleware with IP Tracking**
```php
// app/Http/Middleware/ThrottleAdminLogin.php
public function handle($request, Closure $next)
{
    $ip = $request->ip();
    $key = "admin-login-{$ip}";
    $limit = 5;
    $window = 60; // seconds
    
    if (Cache::has($key)) {
        if (Cache::get($key) >= $limit) {
            return response()->json(['message' => 'Too many login attempts'], 429);
        }
        Cache::increment($key);
    } else {
        Cache::put($key, 1, $window);
    }
    
    return $next($request);
}
```

**Acceptance Criteria:**
- [ ] 1st-5th login attempt: normal processing
- [ ] 6th attempt within 1 min: returns 429 status
- [ ] Error message displayed in UI: "Too many attempts. Please try again in X seconds"
- [ ] Rate limit counter resets after 60 seconds
- [ ] Each IP address has separate counter
- [ ] Successful login does NOT reset the counter (security best practice)

**Testing:**
```php
// tests/Feature/LoginThrottleTest.php
public function test_login_throttled_after_5_attempts()
{
    for ($i = 1; $i <= 5; $i++) {
        $response = $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'wrongpassword'
        ]);
        $this->assertEquals(401, $response->status());
    }
    
    $response = $this->post('/admin/login', [
        'email' => 'admin@test.com',
        'password' => 'wrongpassword'
    ]);
    $this->assertEquals(429, $response->status());
    $this->assertStringContainsString('Too many', $response->getContent());
}
```

---

### 2.2 Contact Form

#### FR-CONTACT-01: Rate Limiting on Contact Submission

**Description:**  
POST `/contact` endpoint harus membatasi submission untuk mencegah spam dan resource abuse.

**Requirements:**
- Max 5 contact form submissions per minute per IP address
- Return HTTP 429 if exceeded
- Display friendly message: "You've submitted recently. Please try again later."

**Implementation:**
```php
// routes/web.php
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');
```

**Acceptance Criteria:**
- [ ] 1st-5th POST /contact: processed normally
- [ ] 6th POST within 1 min: returns 429
- [ ] Counter independent per IP
- [ ] Counter resets after 60 seconds
- [ ] Validation errors (e.g., missing email) bypass throttle check (fail early)

**Testing:**
```php
// tests/Feature/ContactThrottleTest.php
public function test_contact_form_throttled_after_5_submissions()
{
    for ($i = 1; $i <= 5; $i++) {
        $response = $this->post('/contact', [
            'name' => 'User',
            'email' => 'user@test.com',
            'message' => 'Test'
        ]);
        $this->assertEquals(200, $response->status());
    }
    
    $response = $this->post('/contact', [
        'name' => 'User',
        'email' => 'user@test.com',
        'message' => 'Test'
    ]);
    $this->assertEquals(429, $response->status());
}
```

---

#### FR-CONTACT-02: Secure Email Sender Configuration

**Description:**  
Contact form emails harus dikirim dari app's official email address, dengan user email di Reply-To header untuk memastikan deliverability dan prevent spoofing.

**Current Problematic Code:**
```php
// app/Mail/ContactFormMail.php
return $this->from($this->data['email'], $this->data['name'])  // ❌ User email as sender
```

**Desired Implementation:**
```php
// app/Mail/ContactFormMail.php
public function envelope(): Envelope
{
    return new Envelope(
        from: new Address(
            config('mail.from.address'),  // app@portfolio.com
            config('mail.from.name')       // Portfolio App
        ),
        replyTo: [
            new Address($this->data['email'], $this->data['name'])
        ],
        subject: 'New Contact Form Submission'
    );
}

// Or using build() method (older Laravel):
return $this->from(config('mail.from.address'), config('mail.from.name'))
    ->replyTo($this->data['email'], $this->data['name']);
```

**Configuration Changes:**

1. **Move hardcoded recipient to `.env`:**
   ```env
   # .env
   CONTACT_MAIL_TO=dozernapitupulu@gmail.com
   CONTACT_MAIL_TO_NAME=Dozer Napitupulu
   
   # In ContactController:
   Mail::to(config('mail.contact.to'), config('mail.contact.to_name'))
       ->send(new ContactFormMail($validated));
   ```

2. **Update `config/mail.php`:**
   ```php
   'contact' => [
       'to' => env('CONTACT_MAIL_TO', 'support@example.com'),
       'to_name' => env('CONTACT_MAIL_TO_NAME', 'Support'),
   ],
   ```

3. **Ensure `.env.example` updated:**
   ```env
   CONTACT_MAIL_TO=
   CONTACT_MAIL_TO_NAME=
   ```

4. **Verify mail provider settings:**
   - Check SPF record includes mail provider
   - Check DKIM signing enabled
   - Check DMARC policy compatible with app

**Acceptance Criteria:**
- [ ] Email From header = app configured address (e.g., noreply@portfolio.com)
- [ ] Email Reply-To header = user's email
- [ ] Recipient email loaded from `CONTACT_MAIL_TO` env var
- [ ] No hardcoded email addresses in code
- [ ] Existing contact emails in inbox (sent before fix) are not affected
- [ ] New emails have proper From/Reply-To headers

**Testing:**
```php
// tests/Feature/ContactMailTest.php
public function test_contact_email_sender_is_app_address()
{
    Mail::fake();
    
    $this->post('/contact', [
        'name' => 'John',
        'email' => 'john@example.com',
        'message' => 'Hello'
    ]);
    
    Mail::assertSent(ContactFormMail::class, function ($mail) {
        $envelope = $mail->envelope();
        $this->assertEquals(config('mail.from.address'), $envelope->from[0]->address);
        $this->assertEquals('john@example.com', $envelope->replyTo[0]->address);
        return true;
    });
}
```

---

### 2.3 Error Handling

#### FR-ERROR-01: Custom 404 Error Page

**Description:**  
Aplikasi harus menampilkan user-friendly error page untuk invalid routes, bukan error 500.

**Current State (Problematic):**
```php
// routes/web.php
Route::fallback(function () {
    return view('errors.404');  // ❌ View does not exist
});
```

**Required Changes:**

1. **Create view file:**
   ```bash
   touch resources/views/errors/404.blade.php
   ```

2. **Template content:**
   ```blade
   <!-- resources/views/errors/404.blade.php -->
   <!DOCTYPE html>
   <html>
   <head>
       <title>404 - Page Not Found</title>
       <style>
           body { font-family: sans-serif; text-align: center; padding: 50px; }
           h1 { color: #333; }
           p { color: #666; }
           a { color: #007bff; text-decoration: none; }
       </style>
   </head>
   <body>
       <h1>404 - Page Not Found</h1>
       <p>The page you're looking for doesn't exist.</p>
       <a href="{{ url('/') }}">← Back to Home</a>
   </body>
   </html>
   ```

3. **Fallback route already in place:**
   ```php
   // routes/web.php
   Route::fallback(function () {
       return response(view('errors.404'), 404);
   });
   ```

**Acceptance Criteria:**
- [ ] File `resources/views/errors/404.blade.php` exists
- [ ] GET `/invalid-url` returns 404 status (not 500)
- [ ] 404 page displays to user (not Laravel error page)
- [ ] 404 page has "Home" link to back to portfolio
- [ ] 404 page matches portfolio design/styling

**Testing:**
```php
// tests/Feature/ErrorHandlingTest.php
public function test_invalid_route_returns_404()
{
    $response = $this->get('/nonexistent-page-12345');
    $this->assertEquals(404, $response->status());
}

public function test_404_view_rendered()
{
    $response = $this->get('/nonexistent');
    $response->assertViewIs('errors.404');
}

public function test_404_page_has_home_link()
{
    $response = $this->get('/invalid');
    $this->assertStringContainsString('href="' . url('/') . '"', $response->getContent());
}
```

---

### 2.4 Content Security

#### FR-CONTENT-01: XSS Prevention in Personal Project View

**Description:**  
Personal project content (`PersonalProject::content`) harus di-escape untuk prevent XSS injection, terutama dengan kombinasi open admin registration.

**Current Problematic Code:**
```blade
<!-- resources/views/portfolio/personal-project.blade.php -->
{!! $project->content !!}  // ❌ No escaping, rendered as raw HTML
```

**Compare with Safe Implementation:**
```blade
<!-- resources/views/portfolio/project.blade.php -->
{!! nl2br(e($cleanContent)) !!}  // ✓ Properly escaped
```

**Desired Implementation (Conservative):**
```blade
<!-- resources/views/portfolio/personal-project.blade.php -->
{!! nl2br(e($project->content)) !!}  // Escape HTML entities + preserve newlines
```

**Alternative (If Rich HTML needed in future):**
```php
// Use library like mews/purifier
// composer require mews/purifier
return $this->from(input)->sanitizeHtml(
    clean($this->data['content'])
);

// In view:
{!! clean($project->content) !!}
```

**Acceptance Criteria:**
- [ ] `<script>` tags in content are escaped (displayed as text, not executed)
- [ ] All HTML entities properly encoded
- [ ] Line breaks preserved (via `nl2br()`)
- [ ] No security warnings from OWASP scanner
- [ ] Admin can still view/edit the content normally

**Testing:**
```php
// tests/Feature/XSSTest.php
public function test_personal_project_content_xss_escaped()
{
    $malicious = '<script>alert("XSS")</script>';
    
    $project = PersonalProject::create([
        'title' => 'Test',
        'content' => $malicious,
        'slug' => 'test'
    ]);
    
    $response = $this->get("/personal-projects/{$project->slug}");
    
    // Should see escaped version, not execute script
    $this->assertStringContainsString('&lt;script&gt;', $response->getContent());
    $this->assertStringNotContainsString('<script>', $response->getContent());
}
```

---

### 2.5 Data Validation & Consistency

#### FR-SLUG-01: Prevent Slug Collisions

**Description:**  
Slug field harus unique per model. Jika user membuat 2 project dengan title sama, second slug harus auto-append dengan counter (`-2`, `-3`, dll).

**Current Problematic Code:**
```php
// app/Http/Controllers/ProjectController.php
$validated['slug'] = Str::slug($validated['title']);  // ❌ No collision handling
// If duplicate title → DB unique constraint violation
```

**Desired Implementation:**

**Option A: Helper Function**
```php
// app/Helpers/SlugHelper.php
namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    public static function generateUniqueSlug($title, $model, $exceptId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;
        
        $query = $model::where('slug', $slug);
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        
        while ($query->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        
        return $slug;
    }
}

// Usage in Controller:
$validated['slug'] = SlugHelper::generateUniqueSlug(
    $validated['title'],
    Project::class,
    $project->id ?? null
);
```

**Option B: Trait**
```php
// app/Traits/HasUniqueSlug.php
trait HasUniqueSlug
{
    public function generateSlug($title)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;
        
        while ($this->where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = "{$original}-{$count++}";
        }
        
        return $slug;
    }
}

// In Model:
use HasUniqueSlug;

// In Controller:
$validated['slug'] = $project->generateSlug($validated['title']);
```

**Implementation Locations:**
1. `app/Http/Controllers/ProjectController.php` (store, update methods)
2. `app/Http/Controllers/PersonalProjectController.php` (store, update methods)

**Acceptance Criteria:**
- [ ] Creating Project with title "Portfolio" → slug = "portfolio"
- [ ] Creating 2nd Project with title "Portfolio" → slug = "portfolio-1"
- [ ] Creating 3rd → slug = "portfolio-2"
- [ ] Updating project title keeps unique slug
- [ ] No DB constraint violation errors
- [ ] Slugs are URL-safe (lowercase, hyphenated)

**Testing:**
```php
// tests/Feature/ProjectSlugTest.php
public function test_duplicate_slug_gets_counter()
{
    $project1 = Project::create(['title' => 'My Portfolio', ...]);
    $this->assertEquals('my-portfolio', $project1->slug);
    
    $project2 = Project::create(['title' => 'My Portfolio', ...]);
    $this->assertEquals('my-portfolio-1', $project2->slug);
    
    $project3 = Project::create(['title' => 'My Portfolio', ...]);
    $this->assertEquals('my-portfolio-2', $project3->slug);
}
```

---

#### FR-UPLOAD-01: Unified File Upload Strategy

**Description:**  
Semua file upload di aplikasi harus menggunakan `Storage::disk('public')` facade untuk consistency.

**Current Inconsistency:**
```php
// ProjectController.php
Storage::disk('public')->put('projects', $file);  // ✓ Correct

// PersonalProjectController.php
$file->move(public_path('projects'), $filename);  // ❌ Direct filesystem manipulation
$cleanContent = htmlspecialchars($project->featured_image->getClientOriginalExtension());  // ❌ Unsafe
```

**Desired Implementation:**

**Unified Upload Method (in all controllers):**
```php
// app/Http/Controllers/ProjectController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ...
    ]);
    
    // Upload file
    $filename = $request->file('featured_image')->hashName();
    $path = Storage::disk('public')->put('projects', $request->file('featured_image'));
    
    $validated['featured_image'] = $path;
    $validated['slug'] = SlugHelper::generateUniqueSlug($validated['title'], Project::class);
    
    Project::create($validated);
    
    return response()->json(['message' => 'Success']);
}

// Retrieval in Blade:
<img src="{{ Storage::disk('public')->url($project->featured_image) }}" alt="{{ $project->title }}">
// Or in model:
public function getFeaturedImageUrl()
{
    return Storage::disk('public')->url($this->featured_image);
}
```

**Remove Direct `file->move()` calls:**
- [ ] Search codebase for `.move(`
- [ ] Replace all with `Storage::disk('public')->put()`
- [ ] Ensure `php artisan storage:link` in deploy flow

**Acceptance Criteria:**
- [ ] All uploads use `Storage::disk('public')`
- [ ] No direct `public_path()` manipulation in controllers
- [ ] Files accessible via `Storage::disk('public')->url($path)`
- [ ] `public/storage` symlink created on deploy

**Testing:**
```php
// tests/Feature/FileUploadTest.php
public function test_project_image_uploaded_via_storage()
{
    Storage::fake('public');
    
    $response = $this->post('/admin/projects', [
        'title' => 'My Project',
        'featured_image' => UploadedFile::fake()->image('photo.jpg'),
        // ...
    ]);
    
    Storage::disk('public')->assertExists('projects/*');
}
```

---

### 2.6 Admin Features

#### FR-SERVICE-01: Service CRUD Routes Registration (or Removal)

**Description:**  
`ServiceController` dan views ada, tapi routes tidak terdaftar di `routes/admin.php`. Decision: implement atau hapus.

**Current State:**
- ✓ Model: `app/Models/Service.php`
- ✓ Controller: `app/Http/Controllers/Admin/ServiceController.php`
- ✓ Views: `resources/views/admin/services/`
- ✓ Migration: exists
- ❌ Routes: NOT registered

**Option A: Register Routes (Full Implementation)**
```php
// routes/admin.php
Route::middleware(['auth'])->group(function () {
    // ... existing routes ...
    
    Route::resource('services', ServiceController::class);
    // Generates: GET/POST /admin/services, GET/PUT /admin/services/{id}, DELETE /admin/services/{id}
});
```

**Option B: Remove Unused Code (If not used)**
```
# If deciding to remove:
- Delete app/Models/Service.php
- Delete app/Http/Controllers/Admin/ServiceController.php
- Delete resources/views/admin/services/
- Delete migration related to services (but keep in migrations table)
- Update database:tests to not reference Service
- Remove from admin dashboard if listed
```

**Decision Process:**
1. Check if Service model is used anywhere:
   - [ ] Is Service referenced in any view on public portfolio?
   - [ ] Does portfolio page display services?
   - [ ] Is there a services section on homepage?
2. If NO usage → proceed with Option B (remove)
3. If YES usage → proceed with Option A (register routes)

**Acceptance Criteria (Option A):**
- [ ] GET `/admin/services` returns service index page
- [ ] GET `/admin/services/create` returns create form
- [ ] POST `/admin/services` creates service in DB
- [ ] GET `/admin/services/{id}` shows service details
- [ ] GET `/admin/services/{id}/edit` shows edit form
- [ ] PUT `/admin/services/{id}` updates service
- [ ] DELETE `/admin/services/{id}` deletes service

**Acceptance Criteria (Option B):**
- [ ] No references to Service model in codebase
- [ ] No dead routes or controller errors
- [ ] Database migrations still record the history

---

## 3. Non-Functional Requirements

### 3.1 Security (NFR-SEC)

#### NFR-SEC-01: Secure Configuration in Production

**Description:**  
Production `.env` harus memiliki secure default values untuk prevent information disclosure.

**Required Changes:**

```env
# ❌ CURRENT (Insecure)
APP_DEBUG=true
APP_ENV=local
SESSION_ENCRYPT=false

# ✅ DESIRED (Production Safe)
APP_ENV=production
APP_DEBUG=false
SESSION_ENCRYPT=true

# Additional
TRUSTED_PROXIES=*,127.0.0.1
TRUSTED_HOSTS=null
```

**Acceptance Criteria:**
- [ ] Production `.env` has APP_DEBUG=false
- [ ] Production `.env` has APP_ENV=production
- [ ] SESSION_ENCRYPT=true
- [ ] Error pages don't expose stack traces (debug mode off)
- [ ] Logs don't leak sensitive info
- [ ] .env is not tracked in Git (check .gitignore)

**Testing:**
```php
// tests/Feature/ProductionSecurityTest.php
public function test_debug_mode_disabled_in_production()
{
    if (app()->environment('production')) {
        $this->assertFalse(config('app.debug'));
    }
}

public function test_session_encrypted_in_production()
{
    if (app()->environment('production')) {
        $this->assertTrue(config('session.encrypt'));
    }
}
```

---

#### NFR-SEC-02: OWASP Top 10 Compliance

**Description:**  
Aplikasi harus memenuhi OWASP Top 10 security requirements (2021).

| OWASP Item | Requirement | Status |
|-----------|-------------|--------|
| A01: Injection | Validate all input, use prepared statements | ✓ Laravel ORM |
| A02: Authentication | Strong password hashing, secure session | Need: rate limiting, disable open register |
| A03: Sensitive Data | Encrypt sensitive data, HTTPS only | Need: verify HTTPS |
| A04: XML External Entities | Not applicable (no XML) | — |
| A05: Access Control | Proper auth/authz on protected endpoints | ✓ Mostly done, need Service routes |
| A06: Security Misconfiguration | Secure defaults, no unnecessary services | Need: debug mode off, secure headers |
| A07: XSS | Sanitize output, CSP headers | Need: personal project XSS fix |
| A08: Insecure Deserialization | Use safe serialization | ✓ Laravel handles |
| A09: Logging & Monitoring | Log security events | Nice-to-have |
| A10: SSRF | Validate external requests | ✓ No external APIs |

**Acceptance Criteria:**
- [ ] All critical items addressed (A02, A06, A07)
- [ ] No OWASP scanner warnings
- [ ] Security headers present (CSP, X-Content-Type-Options, etc.)

---

### 3.2 Performance (NFR-PERF)

#### NFR-PERF-01: Rate Limit Performance

**Description:**  
Rate limiting tidak harus impact response time secara signifikan.

**Acceptance Criteria:**
- [ ] Rate limit check < 10ms per request
- [ ] No additional database queries per throttle check
- [ ] Cache backend (Redis or file) used consistently
- [ ] Memory footprint of rate limiter < 1MB

---

### 3.3 Reliability (NFR-REL)

#### NFR-REL-01: Email Delivery Reliability

**Description:**  
Contact form emails harus deliver ke inbox dengan SPF/DKIM/DMARC compliance.

**Acceptance Criteria:**
- [ ] SPF record configured correctly
- [ ] DKIM signing enabled
- [ ] DMARC policy set to `p=quarantine` or `p=reject`
- [ ] Test email delivery to real inbox (not spam)
- [ ] Email headers properly formatted

---

#### NFR-REL-02: Deployment Reliability

**Description:**  
Deployment process harus repeatable, idempotent, dan failure-safe.

**Acceptance Criteria:**
- [ ] Deploy script handles network failures gracefully
- [ ] Rollback capability exists (keep previous version)
- [ ] Post-deploy health check verifies app is running
- [ ] No downtime during deploy (or < 30 seconds)
- [ ] All deploy steps logged for audit trail

---

### 3.4 Maintainability (NFR-MAINT)

#### NFR-MAINT-01: Code Quality Standards

**Description:**  
Code harus follow Laravel best practices dan be consistent across codebase.

**Standards:**
- [ ] PSR-12 code style (enforced via Laravel Pint)
- [ ] Meaningful variable/function names
- [ ] No dead code (removed Service routes or implemented)
- [ ] Comments for non-obvious logic
- [ ] Test coverage ≥ 70% for critical paths

**Tools:**
```bash
# Lint code
composer lint

# Lint and fix
composer lint:fix

# Static analysis
composer audit
```

---

## 4. System Integration Requirements

### 4.1 GitHub Actions Integration

#### FR-CI-01: Automated Testing Pipeline

**Description:**  
Every push to `main`/`develop` branch harus trigger automated tests before deploy.

**Requirements:**
- [ ] PHP unit tests (`php artisan test`)
- [ ] Code linting (Laravel Pint)
- [ ] Dependency audit (`composer audit`)
- [ ] Fail build if any check fails
- [ ] Report results to GitHub UI

**Workflow YAML Structure:**
```yaml
name: CI/CD
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: curl,mbstring
      - run: composer install
      - run: composer lint
      - run: composer audit
      - run: php artisan test
  
  deploy:
    needs: test
    if: github.ref == 'refs/heads/main'
    runs-on: ubuntu-latest
    steps:
      # Deploy to production
```

---

#### FR-CI-02: Secure Deployment Workflow

**Description:**  
Deploy process harus safe: exclude sensitive files, run build steps, verify health.

**Requirements:**
- [ ] Build assets (`npm run build`)
- [ ] Install dependencies (`composer install --no-dev`)
- [ ] Exclude `.git`, `node_modules`, `tests`, `.env`, etc.
- [ ] Run migrations on server
- [ ] Create storage symlink
- [ ] Cache configuration
- [ ] Health check (`/up` endpoint)

**Workflow YAML Structure:**
```yaml
deploy:
  needs: test
  runs-on: ubuntu-latest
  steps:
    - uses: actions/checkout@v3
    
    # Build
    - run: npm install && npm run build
    - run: composer install --no-dev --optimize-autoloader
    
    # Deploy via SFTP
    - uses: wlixcc/SFTP-Deploy-Action@v1.2.4
      with:
        username: ${{ secrets.SFTP_USERNAME }}
        server: ${{ secrets.SFTP_SERVER }}
        ssh_private_key: ${{ secrets.SSH_KEY }}
        local_path: './*'
        remote_path: '/home/user/app'
        delete: false
        sftp_only: true
        sftpArgs: '-o ConnectTimeout=5'
    
    # Post-deploy on server
    - name: Run migrations & cache
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.SERVER_HOST }}
        username: ${{ secrets.SSH_USER }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /home/user/app
          composer install --no-dev --optimize-autoloader
          php artisan migrate --force
          php artisan storage:link
          php artisan config:cache
          php artisan route:cache
    
    # Health check
    - run: curl -f https://portfolio.com/up || exit 1
```

---

## 5. Test Requirements

### 5.1 Unit Tests

**Target Coverage:** ≥ 70% for critical models

```php
// tests/Unit/SlugHelperTest.php
public function test_slug_generation()
{
    $slug = SlugHelper::generateUniqueSlug('My Portfolio', Project::class);
    $this->assertEquals('my-portfolio', $slug);
}
```

### 5.2 Feature Tests

**Critical Paths to Test:**

| Feature | Test Case | Expected |
|---------|-----------|----------|
| Auth Login | Valid credentials | 200 OK, redirected to admin panel |
| Auth Login | Invalid credentials | 401 Unauthorized |
| Auth Login | 6th attempt in 1 min | 429 Too Many Requests |
| Admin Register | GET /admin/register | 404 Not Found |
| Admin Register | POST /admin/register | 404 Not Found |
| Contact Form | Valid submission | 200 OK, email sent |
| Contact Form | 6th submission in 1 min | 429 Too Many Requests |
| 404 Error | Invalid route | 404 page rendered |
| Project CRUD | Create project | 201 Created, slug unique |
| Project CRUD | Duplicate title | slug appended with -1 |
| XSS Prevention | Malicious HTML in content | HTML escaped in output |

---

## 6. Deployment & Infrastructure Requirements

### 6.1 Deployment Environment

**Target:** cPanel with public_html document root

**Structure:**
```
/home/dozernap/
├── app/              # Laravel application root (outside web root)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/       # 📌 Document root must point here
│   │   ├── index.php
│   │   ├── css/
│   │   └── js/
│   ├── resources/
│   ├── routes/
│   ├── storage/      # Must be symlinked (not in web root)
│   ├── tests/
│   ├── .env          # 🔒 NOT deployed, created manually on server
│   └── composer.json
└── public_html/      # cPanel symlink → /home/dozernap/app/public

# After deployment:
/home/dozernap/app/public/storage → /home/dozernap/app/storage
```

**cPanel Configuration:**
```
Document Root: /home/dozernap/public_html
(Must be symlink to /home/dozernap/app/public)

PHP Version: 8.2+
Extensions: curl, mbstring, json, gd
```

---

### 6.2 Required Post-Deploy Commands

```bash
# On production server after SFTP sync:

# 1. Install dependencies (vendor/ not in repo)
composer install --no-dev --optimize-autoloader

# 2. Ensure .env exists (created manually beforehand)
# (Not deployed from repo for security)

# 3. Run migrations
php artisan migrate --force

# 4. Create storage symlink
php artisan storage:link

# 5. Cache configuration (production optimization)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Health check
curl -f https://portfolio.com/up

# 7. Verify permissions
chown -R user:group /home/dozernap/app/storage
chmod -R 775 /home/dozernap/app/storage
```

---

## 7. Configuration Checklist

| Item | Current | Required | Owner |
|------|---------|----------|-------|
| APP_DEBUG | true | false | DevOps |
| APP_ENV | local | production | DevOps |
| SESSION_ENCRYPT | false | true | DevOps |
| Database credentials | Via .env | Via .env | DevOps |
| Mail from address | Hardcoded | config/mail.php | Backend |
| Contact recipient | Hardcoded | CONTACT_MAIL_TO env | Backend |
| Admin registration | Open | Disabled | Backend |
| Rate limiting | None | Enabled | Backend |
| Storage disk | Mixed | public only | Backend |
| 404 view | Missing | Created | Frontend |
| XSS protection | Partial | Full | Backend |
| Slug uniqueness | Collision possible | Auto-increment | Backend |
| CI/CD pipeline | Deploy only | Test + Deploy | DevOps |

---

## 8. Acceptance & Sign-Off

| Component | Owner | Status | Sign-Off |
|-----------|-------|--------|----------|
| Security Requirements | Security Lead | — | — |
| Functional Requirements | Backend Lead | — | — |
| Infrastructure Requirements | DevOps Lead | — | — |
| Testing Requirements | QA Lead | — | — |

---

**Document Version:** 1.0  
**Last Updated:** 6 Juli 2026  
**Review Cycle:** Weekly during implementation phase
