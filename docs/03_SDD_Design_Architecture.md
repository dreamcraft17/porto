# Software Design Document (SDD)
## Porto (Laravel 12 Portfolio) — Security & Infrastructure Improvements

**Version:** 1.0  
**Date:** 6 Juli 2026  
**Target Audience:** Backend Engineers, DevOps Engineers, Architects

---

## 1. Design Overview

Document ini mendefinisikan **technical architecture, design patterns, dan implementation details** untuk security improvements dan infrastructure hardening Porto.

---

## 2. System Architecture

### 2.1 Current Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                        Public Internet                          │
└──────────────────────────────────┬──────────────────────────────┘
                                   │
                                   ▼
                    ┌──────────────────────────┐
                    │    GitHub Repository     │
                    │  (Tracked: src code)     │
                    │  (Gitignored: .env)      │
                    └──────────────────────────┘
                                   │
                    GitHub Actions CI/CD Triggered
                                   │
                    ┌──────────────┴───────────────┐
                    ▼                              ▼
            ┌───────────────┐          ┌──────────────────┐
            │  Test Suite   │          │   Build Assets   │
            │ (php artisan  │          │ (npm run build)  │
            │    test)      │          │                  │
            └───────────────┘          └──────────────────┘
                                   │
                                   ▼
                    ┌──────────────────────────┐
                    │   Deploy via SFTP        │
                    │  (GitHub Actions Action) │
                    └──────────────────────────┘
                                   │
                    ┌──────────────┴─────────────────┐
                    ▼                                ▼
          ┌──────────────────────┐       ┌──────────────────────┐
          │  cPanel File Manager │       │  Server SSH Session  │
          │  (file sync via SFTP)│       │ (post-deploy commands)
          └──────────────────────┘       └──────────────────────┘
                    │                                │
                    └──────────────┬─────────────────┘
                                   ▼
          ┌──────────────────────────────────────────────────┐
          │              cPanel Server                        │
          │  /home/dozernap/                                 │
          │   ├── app/                                       │
          │   │   ├── Laravel application                    │
          │   │   ├── .env (manual, not deployed)            │
          │   │   └── public/                                │
          │   └── public_html (symlink to app/public)        │
          │                                                  │
          │  Apache + PHP 8.2 + MySQL                        │
          └──────────────────────────────────────────────────┘
                                   │
                                   ▼
                    ┌──────────────────────────┐
                    │    End User Browser      │
                    │   Portfolio Website      │
                    │   Admin Panel (/admin)   │
                    └──────────────────────────┘
```

### 2.2 New Architecture (Target)

```
┌─────────────────────────────────────────────────────────────────┐
│                        Public Internet                          │
└──────────────────────────────────┬──────────────────────────────┘
                                   │
                                   ▼
                    ┌──────────────────────────┐
                    │    GitHub Repository     │
                    │  (src code + tests)      │
                    │  (Gitignore: .env, etc)  │
                    └──────────────────────────┘
                                   │
                                   ▼
           ┌────────────────── CI/CD Pipeline ─────────────────┐
           │                                                    │
           ├─► [1] Lint (composer lint) ──► FAIL? Stop        │
           ├─► [2] Audit (composer audit) ──► FAIL? Stop      │
           ├─► [3] Tests (php artisan test) ──► FAIL? Stop    │
           ├─► [4] Build (npm run build) ──► FAIL? Stop       │
           └─► [5] Deploy (SFTP) ──► Success ──► Next Steps   │
                                                                │
                    └────────────────────────────────────────────┘
                                   │
                                   ▼
          ┌────────────────── Post-Deploy Script ─────────────┐
          │  (Server-side, via SSH)                           │
          │                                                    │
          ├─► composer install --no-dev --optimize-autoloader │
          ├─► php artisan migrate --force                     │
          ├─► php artisan storage:link                        │
          ├─► php artisan config:cache                        │
          ├─► php artisan route:cache                         │
          └─► Health Check: curl /up                          │
                                                               │
          └────────────────────────────────────────────────────┘
                                   │
                                   ▼
          ┌──────────────────────────────────────────────────┐
          │              Production Server                    │
          │  /home/dozernap/                                 │
          │   ├── app/                           (Live Code)  │
          │   │   ├── app/, bootstrap/, routes/              │
          │   │   ├── public/                                │
          │   │   │   ├── index.php (entry point)            │
          │   │   │   ├── css/, js/ (built via Vite)         │
          │   │   │   └── storage (symlink) ──────┐           │
          │   │   ├── storage/                  ◄─┘           │
          │   │   │   ├── logs/                              │
          │   │   │   ├── app/                               │
          │   │   │   └── framework/                         │
          │   │   ├── .env (SECURE CONFIG)                  │
          │   │   │   ├── APP_DEBUG=false                    │
          │   │   │   ├── APP_ENV=production                 │
          │   │   │   ├── SESSION_ENCRYPT=true               │
          │   │   │   └── (Sensitive values)                 │
          │   │   └── vendor/ (installed via composer)       │
          │   └── public_html (symlink → app/public)         │
          │                                                  │
          │  Security Layer:                                 │
          │  ├── App code (outside webroot)                  │
          │  ├── .env not accessible via web                │
          │  ├── Storage via symlink (config-based)          │
          │  └── Rate limiting on login & contact            │
          │                                                  │
          │  Apache + PHP 8.2 + MySQL                        │
          └──────────────────────────────────────────────────┘
                                   │
                                   ▼
                    ┌──────────────────────────┐
                    │    End User Browser      │
                    │   Portfolio Website      │
                    │   (Public + Secure)      │
                    │   Admin Panel            │
                    │   (Rate Limited Access)  │
                    └──────────────────────────┘
```

---

## 3. Component Design

### 3.1 Authentication Component

#### Design Pattern: Middleware + Gate/Policy

```
User Request
    │
    ▼
Route Middleware: 'auth'
    │
    ├─► Check session exists?
    │   NO → Redirect to /admin/login
    │   YES ▼
    │
    ├─► Check session valid (not expired)?
    │   NO → Redirect to /admin/login
    │   YES ▼
    │
    └─► Allow request to controller
        │
        ▼
    Controller executes
    │
    ▼
    Response to user
```

#### Implementation Details

**Auth Routes (Secured):**
```php
// routes/admin.php

// Public routes (guest middleware)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('admin.login');
    
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')  // Rate limit: 5 attempts/minute
        ->name('admin.login.submit');
});

// Protected routes (auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    
    // CRUD routes (protected)
    Route::resource('projects', ProjectController::class);
    Route::resource('personal-projects', PersonalProjectController::class);
    Route::resource('services', ServiceController::class);  // If implemented
});
```

**AuthController Implementation:**
```php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
        
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }
}
```

#### Rate Limiting Design

**Throttle Middleware (Built-in Laravel):**
```php
// In routes/admin.php
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')  // 5 requests per 1 minute
    ->name('admin.login.submit');

// Config: config/rate-limiting.php or config/cache.php
// Uses cache backend (Redis, memcached, or file cache)
```

**Throttle Behavior:**
```
Request 1 → Allowed (count = 1)
Request 2 → Allowed (count = 2)
Request 3 → Allowed (count = 3)
Request 4 → Allowed (count = 4)
Request 5 → Allowed (count = 5)
Request 6 → BLOCKED (429 Too Many Requests)
            Reset counter after 60 seconds
Request 7 (at 61 seconds) → Allowed (count = 1)
```

**Cache Backend Selection:**
```php
// config/cache.php
'default' => env('CACHE_DRIVER', 'redis'),

// Production options:
// - 'redis' (best, requires Redis server)
// - 'memcached' (good, requires Memcached)
// - 'file' (fallback, uses filesystem, slower)
// - 'database' (fallback, uses DB table)
```

---

### 3.2 Contact Form Component

#### Email Sender Design

**Current Problem:**
```
User Email: visitor@gmail.com
App Config: noreply@portfolio.com

❌ Old Code:
from: visitor@gmail.com  ← Spoofing risk!
to: dozernapitupulu@gmail.com (hardcoded)

⚠️ Result:
- SPF/DKIM fails (gmail.com not authorized)
- Email goes to spam/rejected
- Privacy leak (hardcoded recipient in code)
```

**Desired Design:**
```
User Email: visitor@gmail.com
App From: noreply@portfolio.com
App Config: CONTACT_MAIL_TO=dozer@portfolio.com (or personal email)

✅ New Code:
from: noreply@portfolio.com  ← App domain (SPF aligned)
replyTo: visitor@gmail.com   ← User can be replied to
to: config('mail.contact.to') ← From .env, not hardcoded

✅ Result:
- SPF/DKIM passes ✓
- Email delivered to inbox ✓
- Recipient configurable via .env ✓
```

**Mailable Implementation:**
```php
// app/Mail/ContactFormMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class ContactFormMail extends Mailable
{
    use Queueable;
    
    public function __construct(
        public array $data
    ) {}
    
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address'),
                config('mail.from.name')
            ),
            replyTo: [
                new Address(
                    $this->data['email'],
                    $this->data['name']
                )
            ],
            subject: 'New Contact Form Submission'
        );
    }
    
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: [
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'message' => $this->data['message'],
            ]
        );
    }
}
```

**Configuration:**
```php
// config/mail.php
'mailers' => [
    'smtp' => [
        'driver' => 'smtp',
        'host' => env('MAIL_HOST'),
        'port' => env('MAIL_PORT'),
        'encryption' => env('MAIL_ENCRYPTION'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],
],

'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Porto'),
],

'contact' => [
    'to' => env('CONTACT_MAIL_TO', 'support@example.com'),
    'to_name' => env('CONTACT_MAIL_TO_NAME', 'Support'),
],
```

**Environment Variables:**
```env
# .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_ENCRYPTION=tls
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS=noreply@portfolio.com
MAIL_FROM_NAME=Porto Portfolio

CONTACT_MAIL_TO=dozernapitupulu@gmail.com
CONTACT_MAIL_TO_NAME=Dozer Napitupulu
```

**Usage in Controller:**
```php
// app/Http/Controllers/ContactController.php
public function send(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string|max:1000',
    ]);
    
    Mail::to(
        config('mail.contact.to'),
        config('mail.contact.to_name')
    )->send(new ContactFormMail($validated));
    
    return back()->with('success', 'Message sent successfully!');
}
```

---

### 3.3 File Upload Component

#### Unified Storage Design

**Pattern: Storage Facade with Disk Configuration**

```
File Upload
    │
    ▼
validate mime type, size
    │
    ▼
$file->store() via Storage::disk('public')
    │
    ├─► Storage driver: 'public'
    ├─► Disk root: /storage/app/public
    ├─► Web accessible: /storage/... (via symlink)
    └─► Filename: hashName() for security
    │
    ▼
Database stores relative path: 'projects/abc123.jpg'
    │
    ▼
Retrieval: Storage::disk('public')->url($path)
    │
    └─► Returns: /storage/projects/abc123.jpg
```

**Configuration:**
```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL') . '/storage',
        'visibility' => 'public',
    ],
],
```

**Implementation in Controller:**
```php
// app/Http/Controllers/Admin/ProjectController.php
public function store(StoreProjectRequest $request)
{
    $validated = $request->validated();
    
    // Upload featured image
    if ($request->hasFile('featured_image')) {
        $path = $request->file('featured_image')
            ->store('projects', 'public');  // stores in storage/app/public/projects/
        
        $validated['featured_image'] = $path;
    }
    
    // Slug generation
    $validated['slug'] = SlugHelper::generateUniqueSlug(
        $validated['title'],
        Project::class
    );
    
    // Save to database
    $project = Project::create($validated);
    
    return redirect()->route('admin.projects.show', $project);
}

public function update(UpdateProjectRequest $request, Project $project)
{
    $validated = $request->validated();
    
    // Handle image replacement
    if ($request->hasFile('featured_image')) {
        // Delete old image
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }
        
        // Upload new image
        $path = $request->file('featured_image')
            ->store('projects', 'public');
        
        $validated['featured_image'] = $path;
    }
    
    $project->update($validated);
    
    return redirect()->route('admin.projects.show', $project);
}
```

**Retrieval in Views:**
```blade
<!-- resources/views/portfolio/project.blade.php -->
<img 
    src="{{ Storage::disk('public')->url($project->featured_image) }}" 
    alt="{{ $project->title }}"
>

<!-- Or use accessor in model: -->
<img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}">
```

**Model Accessor:**
```php
// app/Models/Project.php
class Project extends Model
{
    protected $appends = ['featured_image_url'];
    
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return Storage::disk('public')->url($this->featured_image);
        }
        return '/images/placeholder.jpg';
    }
}
```

**Deployment Requirement:**
```bash
# On production server after deploy
php artisan storage:link

# Creates symlink:
# /home/dozernap/app/public/storage → /home/dozernap/app/storage/app/public
```

---

### 3.4 Data Validation Component

#### Slug Generation Design

**Pattern: Unique Slug Generation with Auto-Increment**

```
User Input: "My Portfolio"
             │
             ▼
        Str::slug() ─► "my-portfolio"
             │
             ▼
    Check if exists in DB
        │
        ├─ NO ─► Return "my-portfolio"
        │
        └─ YES ─► Append counter
                   │
                   ├─ Check "my-portfolio-1"? NO ─► Return "my-portfolio-1"
                   └─ Check "my-portfolio-1"? YES ─► Check "my-portfolio-2"...
```

**Implementation: Helper Class**
```php
// app/Helpers/SlugHelper.php
namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * Generate unique slug with auto-increment counter
     */
    public static function generateUniqueSlug(
        string $title,
        string $modelClass,
        ?int $exceptId = null
    ): string {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;
        
        while (self::slugExists($slug, $modelClass, $exceptId)) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        
        return $slug;
    }
    
    private static function slugExists(
        string $slug,
        string $modelClass,
        ?int $exceptId
    ): bool {
        $query = $modelClass::where('slug', $slug);
        
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        
        return $query->exists();
    }
}
```

**Usage in Controller:**
```php
// app/Http/Controllers/Admin/ProjectController.php
use App\Helpers\SlugHelper;

public function store(StoreProjectRequest $request)
{
    $validated = $request->validated();
    
    $validated['slug'] = SlugHelper::generateUniqueSlug(
        $validated['title'],
        Project::class
    );
    
    Project::create($validated);
}

public function update(UpdateProjectRequest $request, Project $project)
{
    $validated = $request->validated();
    
    // If title changed, regenerate slug
    if ($validated['title'] !== $project->title) {
        $validated['slug'] = SlugHelper::generateUniqueSlug(
            $validated['title'],
            Project::class,
            $project->id  // Exclude current project
        );
    }
    
    $project->update($validated);
}
```

**Database Migration:**
```php
// Ensure slug is unique
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();  // ← Constraint
    $table->longText('description');
    $table->timestamps();
});
```

---

### 3.5 Security Component: XSS Prevention

#### Design Pattern: Output Escaping

```
User Input (untrusted)
    │
    ▼
Store in Database (raw)
    │
    ▼
Retrieve from Database
    │
    ▼
Output with escaping
    │
    ├─ e() : HTML entity escape
    ├─ n12br() : Preserve newlines
    └─ Blade {!! !html_purify() !!} : Rich HTML (future)
    │
    ▼
Rendered to browser (safe)
```

**Safe Implementation (Recommended MVP):**
```blade
<!-- resources/views/portfolio/personal-project.blade.php -->

<!-- ❌ UNSAFE (current) -->
{!! $project->content !!}

<!-- ✅ SAFE (desired) -->
{!! nl2br(e($project->content)) !!}

<!-- With additional context -->
<div class="project-content">
    {!! nl2br(e($project->content)) !!}
</div>
```

**If Rich HTML Needed (Future):**
```php
// composer require mews/purifier

// In config/purifier.php
'settings' => [
    'default' => [
        'tags' => ['p', 'br', 'strong', 'em', 'a', 'ul', 'ol', 'li'],
        'attributes' => ['a' => ['href', 'title']],
    ],
],

// In Blade:
{!! clean($project->content) !!}
```

**Test XSS Prevention:**
```php
// tests/Feature/XSSTest.php
public function test_xss_prevented_in_personal_project()
{
    $maliciousContent = '<script>alert("XSS")</script>';
    
    $project = PersonalProject::create([
        'title' => 'Test Project',
        'content' => $maliciousContent,
        'slug' => 'test-project'
    ]);
    
    $response = $this->get("/personal-projects/{$project->slug}");
    
    // Should see escaped script tag, not executable
    $this->assertStringContainsString('&lt;script&gt;', $response->getContent());
}
```

---

### 3.6 Error Handling Component

#### Custom Error Pages Design

**Laravel Error Pages Structure:**
```
resources/views/
├── errors/
│   ├── 404.blade.php    ← Not Found
│   ├── 500.blade.php    ← Server Error
│   ├── 503.blade.php    ← Service Unavailable
│   └── layout.blade.php ← Shared error layout
```

**404 Error Page:**
```blade
<!-- resources/views/errors/404.blade.php -->
@extends('errors::layout')

@section('title', '404 - Not Found')

@section('content')
<div class="error-container">
    <h1>404 - Page Not Found</h1>
    <p>The page you're looking for doesn't exist.</p>
    
    <div class="error-actions">
        <a href="{{ url('/') }}" class="btn btn-primary">
            ← Back to Home
        </a>
    </div>
    
    <p class="error-help">
        If you think this is a mistake, please 
        <a href="{{ route('contact.form') }}">contact us</a>.
    </p>
</div>
@endsection
```

**Fallback Route:**
```php
// routes/web.php (at the end)
Route::fallback(function () {
    return response(view('errors.404'), 404);
});
```

---

## 4. Deployment Architecture

### 4.1 GitHub Actions CI/CD Pipeline

#### Workflow Design

```yaml
name: CI/CD
on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]

jobs:
  # Job 1: Test
  test:
    runs-on: ubuntu-latest
    steps:
      # Setup
      - uses: actions/checkout@v3
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: curl,mbstring,json,gd
      
      # Composer
      - run: composer install
      
      # Lint
      - name: Lint Code
        run: composer lint
      
      # Security Audit
      - name: Composer Audit
        run: composer audit
      
      # Tests
      - name: Run Tests
        run: php artisan test
  
  # Job 2: Build (only on push to main)
  build:
    needs: test
    if: github.ref == 'refs/heads/main' && github.event_name == 'push'
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Setup Node
        uses: actions/setup-node@v3
        with:
          node-version: '18'
      
      - name: Install npm dependencies
        run: npm install
      
      - name: Build assets
        run: npm run build
      
      - name: Upload build artifacts
        uses: actions/upload-artifact@v3
        with:
          name: build
          path: public/
  
  # Job 3: Deploy (only on push to main)
  deploy:
    needs: [test, build]
    if: github.ref == 'refs/heads/main' && github.event_name == 'push'
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Download build artifacts
        uses: actions/download-artifact@v3
        with:
          name: build
          path: public/
      
      - name: Setup SSH
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.SSH_PRIVATE_KEY }}" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -H ${{ secrets.SERVER_HOST }} >> ~/.ssh/known_hosts
      
      - name: Deploy via SFTP
        run: |
          # Using lftp for selective SFTP sync
          lftp sftp://${{ secrets.SFTP_USER }}@${{ secrets.SERVER_HOST }} \
            -e "
              mirror --reverse \
                --exclude '.git/' \
                --exclude 'node_modules/' \
                --exclude 'tests/' \
                --exclude '.env' \
                --exclude '.github/' \
                --exclude '.env.example' \
                . /home/dozernap/app \
              quit
            " \
            -i /home/runner/.ssh/deploy_key
      
      - name: Run post-deploy commands
        run: |
          ssh -i ~/.ssh/deploy_key ${{ secrets.SSH_USER }}@${{ secrets.SERVER_HOST }} << 'EOF'
            set -e
            
            cd /home/dozernap/app
            
            # Install composer dependencies
            composer install --no-dev --optimize-autoloader
            
            # Run migrations
            php artisan migrate --force
            
            # Create storage symlink
            php artisan storage:link
            
            # Cache configuration
            php artisan config:cache
            php artisan route:cache
            php artisan view:cache
            
            # Fix permissions
            chmod -R 775 storage/ bootstrap/cache/
          EOF
      
      - name: Health Check
        run: |
          for i in {1..5}; do
            curl -f https://portfolio.com/up && exit 0
            sleep 2
          done
          exit 1
```

#### Secrets Configuration

Required GitHub Secrets:
```
SSH_PRIVATE_KEY        = SSH private key for deployment
SFTP_USER             = SSH username (e.g., dozernap)
SERVER_HOST           = Server IP or domain
SSH_USER              = Same as SFTP_USER
```

---

### 4.2 Post-Deploy Script

**Server-Side Script** (executed via SSH after SFTP sync):

```bash
#!/bin/bash
# File: /home/dozernap/deploy.sh

set -e  # Exit on error

cd /home/dozernap/app

echo "=== Starting Post-Deployment ==="

# 1. Install dependencies
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# 2. Ensure .env exists
if [ ! -f .env ]; then
    echo "ERROR: .env file not found!"
    exit 1
fi

# 3. Run migrations
echo "Running database migrations..."
php artisan migrate --force

# 4. Create storage symlink
echo "Creating storage symlink..."
php artisan storage:link

# 5. Cache configuration (production optimization)
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Fix permissions
echo "Fixing permissions..."
chmod -R 775 storage/ bootstrap/cache/

# 7. Clear old caches
echo "Clearing caches..."
php artisan cache:clear
php artisan view:clear

# 8. Health check
echo "Running health check..."
if curl -f http://localhost/up > /dev/null 2>&1; then
    echo "✓ Application is healthy"
else
    echo "✗ Health check failed!"
    exit 1
fi

echo "=== Deployment Complete ==="
```

---

### 4.3 cPanel Configuration

**Required cPanel Setup:**

```
Document Root: /home/dozernap/public_html
(Must be symlink to /home/dozernap/app/public)

Symlink Setup:
$ cd /home/dozernap/
$ ln -s app/public public_html

PHP Version: 8.2+
Extensions Required: curl, mbstring, json, gd, pdo_mysql

MySQL Database: portfolio_app
```

**File Permissions:**
```bash
# Make app directory group-writable for storage/
chown -R dozernap:dozernap /home/dozernap/app
chmod -R 755 /home/dozernap/app
chmod -R 775 /home/dozernap/app/storage
chmod -R 775 /home/dozernap/app/bootstrap/cache

# Make .env read-only by app
chmod 600 /home/dozernap/app/.env
```

---

## 5. Database Design

### 5.1 User Authentication

**Table: users**
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  -- hashed via Hash::make()
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Index for login
CREATE INDEX idx_users_email ON users(email);
```

### 5.2 Projects

**Table: projects**
```sql
CREATE TABLE projects (
    id BIGINT UNSIGNED PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description LONGTEXT NOT NULL,
    featured_image VARCHAR(255),      -- path from Storage::disk('public')
    technologies JSON,                -- stored as JSON array
    repository_url VARCHAR(255),
    live_url VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Indexes
CREATE INDEX idx_projects_slug ON projects(slug);
CREATE INDEX idx_projects_created_at ON projects(created_at);
```

---

## 6. Security Considerations

### 6.1 OWASP Top 10 Mitigations

| OWASP Item | Mitigation |
|-----------|-----------|
| A01: Injection | Laravel ORM + prepared statements |
| A02: Authentication | Password hashing, rate limiting, secure session |
| A03: Sensitive Data | .env not deployed, encrypted session |
| A07: XSS | Output escaping (e() + nl2br()) |
| A06: Misconfiguration | APP_DEBUG=false, secure headers |
| A05: Access Control | Route middleware (auth), gate/policy |

### 6.2 Security Headers

**In `.htaccess` or nginx config:**
```apache
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>
```

### 6.3 HTTPS Enforcement

**In `.htaccess`:**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

---

## 7. Performance Considerations

### 7.1 Database Optimization
- Add indexes on frequently queried columns (slug, email)
- Use eager loading (`with()`) to prevent N+1 queries
- Cache database queries where appropriate

### 7.2 Caching Strategy
- Cache routes and configuration in production
- Use Redis for rate limiting cache (faster than file)
- Cache Laravel views

### 7.3 Asset Optimization
- Use Vite for asset bundling (development + production)
- Minify CSS/JS in production build
- Compress images before upload

---

## 8. Monitoring & Logging

### 8.1 Application Logs
**Location:** `/home/dozernap/app/storage/logs/laravel.log`

**Log Levels:** error, warning, info, debug

### 8.2 Error Tracking (Optional)
```
Sentry / Rollbar / New Relic
- Track 500 errors in production
- Monitor performance metrics
- Alert on critical issues
```

---

## 9. Rollback Strategy

**If deploy fails:**

```bash
# GitHub Actions automatically:
1. Keeps previous deploy artifacts
2. Logs failed deploy in GitHub Actions UI

# Manual rollback:
1. SSH to server
2. Revert to previous git commit
3. Re-run post-deploy script (migrations idempotent)
4. Or keep previous version as backup
```

---

## 10. Testing Strategy

### 10.1 Test Structure
```
tests/
├── Feature/
│   ├── AuthTest.php
│   ├── ContactTest.php
│   ├── ProjectCRUDTest.php
│   └── ErrorHandlingTest.php
├── Unit/
│   ├── SlugHelperTest.php
│   └── StorageTest.php
└── TestCase.php
```

### 10.2 Test Execution
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Feature/AuthTest.php

# With coverage
php artisan test --coverage
```

---

## 11. Design Decision Summary

| Decision | Rationale |
|----------|-----------|
| Admin register disabled | Prevent unauthorized account creation |
| Rate limiting on login | Prevent brute force attacks |
| Email from app domain | SPF/DKIM alignment, prevent spoofing |
| Storage facade (not file->move) | Consistency, better control, symlink support |
| Slug auto-increment | Graceful handling of duplicate titles |
| XSS escaping (not rich HTML) | Security first, simpler MVP |
| GitHub Actions CI | Free, integrated, sufficient for this project |
| SFTP deploy | cPanel compatible, simpler than SSH |
| POST-deploy script | Ensure consistent deployment every time |

---

**Document Version:** 1.0  
**Last Updated:** 6 Juli 2026  
**Architecture Review Date:** TBD
