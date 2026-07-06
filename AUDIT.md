# Audit Project Porto (Laravel 12 Portfolio)

> Tanggal audit: 6 Juli 2026  
> Stack: Laravel 12, PHP 8.2+, Blade, Vite, deploy cPanel via GitHub Actions SFTP

---

## Ringkasan

| Area | Status |
|------|--------|
| Keamanan auth | **Kritis** — registrasi admin terbuka |
| Deploy / infra | **Tinggi** — workflow SFTP berisiko |
| Kualitas kode | **Sedang** — inkonsistensi & dead code |
| Testing / CI | **Lemah** — hampir tidak ada |
| Dependencies | Laravel 12 modern, `.env` di-gitignore dengan benar |

---

## Kritis — Perlu Segera

### 1. Registrasi admin terbuka ke publik

Siapa saja bisa membuat akun admin lewat `/admin/register`.

**Lokasi:** `routes/admin.php`

```php
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register']);
});
```

Halaman login juga menampilkan link "Register here" (`resources/views/admin/auth/login.blade.php`).

**Risiko:** Attacker bisa langsung mengambil alih CMS portfolio.

**Rekomendasi:**

- Hapus route register (GET & POST), atau
- Batasi dengan env flag / invite-only, atau
- Buat user admin hanya via `php artisan tinker` / seeder sekali jalan

---

### 2. Deploy SFTP ke `public_html` tanpa build step

**Lokasi:** `.github/workflows/deploy.yml`

```yaml
local_path: './*'
remote_path: '/home/dozernap/public_html'
sftp_only: true
```

**Masalah:**

| Issue | Dampak |
|-------|--------|
| `local_path: './*'` upload seluruh repo ke document root | Folder `app/`, `config/`, `routes/` bisa ter-expose jika docroot bukan `public/` |
| `vendor/` tidak ikut (gitignored) | App di server bisa rusak kecuali `composer install` dijalankan manual |
| Tidak ada `npm run build` | Asset production mungkin outdated |
| Tidak ada `php artisan migrate` | Schema DB tidak sinkron |
| Tidak ada `storage:link`, `config:cache` | Fitur upload / performa bermasalah |
| Auth via `SSH_PASSWORD` | Lebih rentan daripada SSH key |
| Tidak ada exclude pattern | `.git`, `tests/`, `.github/` ikut ter-upload |

**Rekomendasi:**

- Struktur Laravel standar di cPanel: app di luar web root, document root = `public/`
- Workflow deploy hanya sync file yang diperlukan + post-deploy script di server
- Gunakan SSH key, bukan password
- Tambahkan exclude: `.git`, `node_modules`, `tests`, `.github`, `.env`

---

### 3. View 404 tidak ada

**Lokasi:** `routes/web.php`

```php
Route::fallback(function () {
    return view('errors.404');
});
```

Folder `resources/views/errors/` **tidak ada** → URL tidak valid bisa menghasilkan error 500, bukan halaman 404.

**Rekomendasi:** Buat `resources/views/errors/404.blade.php`.

---

## Tinggi

### 4. Tidak ada rate limiting (login & contact)

- `AuthController::login()` tidak memakai `RateLimiter` / middleware `throttle`
- `POST /contact` tidak dibatasi → rentan spam email & abuse resource

**Rekomendasi:**

```php
// routes/web.php
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Login: tambahkan throttle di controller atau route middleware
```

---

### 5. Contact form — email spoofing

**Lokasi:** `app/Mail/ContactFormMail.php`

```php
return $this->from($this->data['email'], $this->data['name'])
```

**Masalah:**

- `from()` memakai email visitor → sering ditolak SPF/DKIM
- Bisa disalahgunakan untuk spoofing

**Rekomendasi:**

```php
return $this->from(config('mail.from.address'), config('mail.from.name'))
    ->replyTo($this->data['email'], $this->data['name'])
```

Pindahkan email tujuan dari hardcode (`dozernapitupulu@gmail.com` di `ContactController`) ke `.env`:

```env
CONTACT_MAIL_TO=dozernapitupulu@gmail.com
```

---

### 6. Stored XSS di personal project

**Lokasi:** `resources/views/portfolio/personal-project.blade.php`

```blade
{!! $project->content !!}
```

Konten HTML dirender tanpa escape. Aman selama hanya admin trusted yang input — tapi kombinasi dengan registrasi admin terbuka (#1) membuat ini sangat berbahaya.

**Perbandingan:** `project.blade.php` sudah benar:

```blade
{!! nl2br(e($cleanContent)) !!}
```

**Rekomendasi:** Sanitize HTML (mis. HTMLPurifier) atau escape seperti project biasa, kecuali memang sengaja rich HTML dari admin terpercaya saja.

---

### 7. Service CRUD — route tidak terdaftar

`ServiceController` + views admin (`resources/views/admin/services/`) ada, tapi **tidak ada route** di `routes/admin.php`.

Akses ke `admin.services.*` akan error. Fitur setengah jadi / dead code.

**Rekomendasi:** Daftarkan route di `admin.php`, atau hapus controller + views + migration jika tidak dipakai.

---

### 8. Konfigurasi production belum aman

**Lokasi:** `.env.example`

| Setting | Nilai saat ini | Risiko |
|---------|----------------|--------|
| `APP_DEBUG` | `true` | Stack trace bisa bocor di production |
| `SESSION_ENCRYPT` | `false` | Session tidak terenkripsi |

**Rekomendasi untuk production:**

```env
APP_ENV=production
APP_DEBUG=false
SESSION_ENCRYPT=true
```

---

## Sedang

### 9. Upload file inkonsisten

| Controller | Metode |
|-----------|--------|
| `ProjectController` | `Storage::disk('public')` ✓ |
| `PersonalProjectController` | `$file->move(public_path(...))` + `getClientOriginalExtension()` |

Keduanya sudah divalidasi `mimes:jpeg,png,jpg,gif`, tapi pola berbeda. Personal project langsung ke `public/` tanpa storage symlink.

**Rekomendasi:** Unifikasi ke `Storage::disk('public')` + `php artisan storage:link`.

---

### 10. Slug bisa bentrok

**Lokasi:** `ProjectController`, `PersonalProjectController`

```php
$validated['slug'] = Str::slug($validated['title']);
```

Tidak ada suffix unik (`-2`, `-3`). Judul duplikat → error DB (kolom `slug` punya constraint `unique()`).

**Rekomendasi:**

```php
$slug = Str::slug($validated['title']);
$original = $slug;
$count = 1;
while (Project::where('slug', $slug)->where('id', '!=', $project->id ?? 0)->exists()) {
    $slug = $original . '-' . $count++;
}
$validated['slug'] = $slug;
```

---

### 11. Double JSON encode pada `technologies`

Controller melakukan `json_encode()` manual, padahal model sudah:

```php
protected $casts = ['technologies' => 'array'];
```

**Rekomendasi:** Pass array langsung ke model, biarkan Eloquent cast yang handle encoding.

---

### 12. Monolith view

| File | Baris |
|------|-------|
| `resources/views/portfolio/index.blade.php` | ~1.820 |
| `resources/views/portfolio/personal-project.blade.php` | ~632 |

CSS, HTML, dan JS inline dalam satu file — sulit maintain dan review.

**Rekomendasi:** Pecah ke Blade components, pindahkan CSS/JS ke Vite assets.

---

### 13. Tidak ada CI selain deploy

Tidak ada workflow untuk:

- `php artisan test`
- Laravel Pint (sudah ada di `require-dev`)
- `composer audit`

Deploy langsung ke production tanpa quality gate.

**Rekomendasi:** Tambah workflow `ci.yml` yang jalan sebelum merge/deploy.

---

## Rendah / Nice-to-have

- **Testing:** Hanya `tests/Feature/ExampleTest.php` — tidak ada test auth, contact, CRUD
- **README:** Masih default Laravel skeleton, belum dokumentasi project portfolio
- **Service model:** Migration + admin views ada, tapi tidak dipakai di frontend portfolio
- **Logout route** di luar middleware `auth` — minor CSRF concern
- **Health check** `/up` sudah ada (Laravel 11+) ✓
- **CSRF** contact form sudah benar (token + `X-CSRF-TOKEN` header) ✓
- **Password hashing** via cast `hashed` + `Hash::make` ✓
- **Mass assignment** model sudah `$fillable` ✓
- **`.gitignore`** sudah cover `.env`, `vendor`, dll ✓

---

## Prioritas Perbaikan

```
SEGERA
├── Nonaktifkan /admin/register
├── Perbaiki deploy workflow (struktur + build + exclude)
└── Buat view errors/404

MINGGU INI
├── Rate limit login + contact form
├── Fix email from/replyTo + env CONTACT_MAIL_TO
├── APP_DEBUG=false di production
└── Daftarkan atau hapus Service routes

BACKLOG
├── Refactor index.blade.php (components + Vite)
├── Tambah feature tests
├── Unifikasi upload strategy
└── Fix slug collision + technologies encoding
```

---

## Checklist Production

- [ ] Tutup route `/admin/register`
- [ ] Audit tabel `users` — hapus akun tidak dikenal
- [ ] `APP_DEBUG=false`, `APP_ENV=production`
- [ ] `SESSION_ENCRYPT=true`
- [ ] Document root cPanel = folder `public/`
- [ ] `.env` ada di server (tidak di-deploy dari repo)
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] `npm run build`
- [ ] `php artisan migrate --force`
- [ ] `php artisan storage:link`
- [ ] `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- [ ] Rate limiting aktif di login & contact
- [ ] Email contact pakai `replyTo`, bukan `from` visitor

---

## Kesimpulan

Project ini **fungsional sebagai portfolio CMS**, tetapi ada **dua celah keamanan serius**:

1. **Registrasi admin terbuka** — siapa saja bisa jadi admin
2. **Deploy workflow** — berpotensi expose struktur Laravel dan tidak menjalankan build/migrate

Contact form juga rentan spam tanpa rate limiting.

Jika situs sudah live, **prioritas #1 = tutup `/admin/register`** dan audit apakah ada akun admin tidak dikenal di database.
