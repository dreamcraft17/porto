# Product Requirements Document (PRD)
## Porto (Laravel 12 Portfolio) — Security & Infrastructure Improvements

**Project:** Portfolio CMS Security & Deployment Hardening  
**Version:** 1.0  
**Date:** 6 Juli 2026  
**Audience:** Engineering Team, Project Manager, DevOps

---

## 1. Executive Summary

Porto (Laravel 12 portfolio) adalah aplikasi CMS fungsional untuk portfolio personal, namun memiliki **dua celah keamanan serius** dan beberapa **risiko infrastruktur deployment** yang harus ditangani sebelum production.

**Tujuan PRD ini:** Mendefinisikan requirements untuk menghilangkan security gaps, meningkatkan reliability, dan membuat deployment process aman dan scalable.

**Timeline:** 
- **Phase 1 (URGENT - Sebelum Production):** 1 minggu
- **Phase 2 (Quality Improvements):** 2 minggu
- **Phase 3 (Refactoring & Testing):** Sprint berikutnya

---

## 2. Business Goals & Success Metrics

### Business Goals
1. **Keamanan:** Aplikasi siap untuk production tanpa security risks
2. **Reliability:** Deployment process yang konsisten, repeatable, dan aman
3. **Maintainability:** Kode yang lebih modular dan mudah di-audit
4. **Compliance:** Memenuhi standar OWASP Top 10 & best practices Laravel

### Success Metrics
- ✅ 0 critical vulnerabilities (sesuai OWASP)
- ✅ 100% security checklist passed sebelum launch
- ✅ Automated CI/CD pipeline berjalan sebelum deploy
- ✅ Zero downtime deployment
- ✅ Test coverage ≥ 70% untuk auth & contact critical paths

---

## 3. Problem Statement & Scope

### Critical Issues (Must Fix)

| ID | Issue | Impact | Deadline |
|----|-------|--------|----------|
| **SEC-1** | Registrasi admin terbuka publik | Siapa saja bisa jadi admin | URGENT (hari 1) |
| **INF-1** | Deploy workflow unsafe (upload seluruh repo) | Expose struktur Laravel, missing build steps | URGENT (hari 2-3) |
| **ERR-1** | View 404 tidak ada | 500 error untuk invalid routes | URGENT (hari 1) |

### High Priority Issues (1-2 minggu)

| ID | Issue | Impact |
|----|-------|--------|
| **SEC-2** | Rate limiting missing (login, contact) | Brute force, email spam abuse |
| **SEC-3** | Email spoofing di contact form | SPF/DKIM rejection, reputasi domain |
| **SEC-4** | XSS di personal project view | Injection attack (mitigated oleh registrasi terbuka) |
| **SEC-5** | APP_DEBUG=true di production | Stack trace leakage |
| **CODE-1** | Service CRUD route missing | Dead code, inconsistent experience |

### Medium Priority Issues (Backlog)

| ID | Issue | Impact |
|----|-------|--------|
| **CODE-2** | Upload file strategy tidak konsisten | Maintenance burden, potential bugs |
| **CODE-3** | Slug collision possible | DB unique constraint violation |
| **CODE-4** | View monolith (~1.8K lines) | Hard to maintain & review |
| **TEST-1** | No CI/testing automation | Regressions, quality debt |

---

## 4. Scope Definition

### In Scope (Phase 1-2)
- ✅ Menonaktifkan registrasi admin (`/admin/register`)
- ✅ Redesign & implement secure deployment workflow
- ✅ Create 404 error view
- ✅ Add rate limiting (login, contact endpoints)
- ✅ Fix email sender configuration (replyTo pattern)
- ✅ Secure production `.env` settings
- ✅ Register atau remove Service CRUD routes
- ✅ Basic feature tests untuk auth & contact

### Out of Scope (Future/Backlog)
- ❌ Full view refactoring (components) — target Phase 3
- ❌ Rich HTML editor dengan sanitization — Phase 3
- ❌ Comprehensive integration testing suite — Phase 3
- ❌ Infrastructure as Code (Terraform/Ansible) — Phase 4
- ❌ Multi-environment management (staging/prod parity) — Phase 4

---

## 5. Requirements Overview

### 5.1 Security Requirements

#### SEC-1: Admin Registration Control
- **Requirement:** Menonaktifkan akses publik ke `/admin/register`
- **Implementation Option:**
  - Option A: Hapus route register GET & POST sepenuhnya
  - Option B: Guard dengan ENV flag (e.g., `ALLOW_ADMIN_REGISTRATION=false`)
  - Option C: Invite-only dengan token yang di-generate via artisan command
- **Audit Step:** Pastikan tabel `users` di production hanya punya 1 akun admin yang authorized

#### SEC-2: Rate Limiting
- **Requirement:** Lindungi login & contact form dari brute force & spam
- **Targets:**
  - `POST /admin/login`: max 5 attempts per minute per IP
  - `POST /contact`: max 5 requests per minute per IP
- **Tech:** Middleware `throttle` Laravel atau Redis-backed limiter
- **Fallback:** Return 429 Too Many Requests dengan UI message

#### SEC-3: Email Security (Contact Form)
- **Requirement:** Prevent email spoofing, ensure deliverability
- **Changes:**
  - Sender (from) → use app config address, bukan visitor email
  - Reply-To → set visitor email
  - Move hardcoded recipient to `.env` (`CONTACT_MAIL_TO`)
  - Validate SPF, DKIM config di server

#### SEC-4: XSS Prevention
- **Requirement:** Prevent stored XSS di personal project content
- **Implementation:**
  - Option A: HTML Purify user content (if rich HTML needed)
  - Option B: Escape output like `project.blade.php` (nl2br + e())
- **Recommendation:** Option B untuk MVP, Option A jika future feature butuh rich HTML

#### SEC-5: Production Environment Hardening
- **Requirement:** Secure default `.env` di production
- **Changes:**
  - `APP_DEBUG=false`
  - `APP_ENV=production`
  - `SESSION_ENCRYPT=true`
  - `.env` file NOT deployed via Git, managed on server directly

### 5.2 Infrastructure Requirements

#### INF-1: Secure Deployment Workflow
- **Requirement:** Deployment aman, repeatable, with proper build steps
- **Key Changes:**
  - Document root = `public/` folder (not `public_html/` direct)
  - Exclude files: `.git`, `node_modules`, `tests/`, `.github/`, `.env`
  - Run build pipeline: `npm run build`, `composer install --no-dev`
  - Run migrations: `php artisan migrate --force`
  - Cache config & routes: `config:cache`, `route:cache`
  - Setup storage symlink: `php artisan storage:link`
  - Use SSH key authentication (not password)
- **Tooling:** GitHub Actions + custom deploy script, or dedicated CI/CD platform (e.g., Laravel Forge, Deployer.org)

#### INF-2: CI/CD Pipeline
- **Requirement:** Automated quality gates sebelum production deploy
- **Steps:**
  - Lint: `composer lint` (Laravel Pint)
  - Security: `composer audit`
  - Test: `php artisan test`
  - Build: `npm run build`
  - Code quality: Optional (SonarQube, Scrutinizer)

### 5.3 Code Quality Requirements

#### CODE-1: Service CRUD Routes
- **Requirement:** Consistency antara model, controller, route
- **Options:**
  - Option A: Implement full Service CRUD (index, show, edit, delete) di admin panel
  - Option B: Remove unused Service model, controller, views
- **Recommendation:** Audit usage — jika tidak dipakai, hapus untuk reduce dead code

#### CODE-2: Upload File Consolidation
- **Requirement:** Unify upload strategy across controllers
- **Standard:** Use `Storage::disk('public')` everywhere
- **Ensure:** `php artisan storage:link` di deployment flow
- **Remove:** Direct `$file->move()` calls, use Storage facade

#### CODE-3: Slug Collision Fix
- **Requirement:** Handle duplicate slugs gracefully
- **Implementation:** Auto-append `-1`, `-2`, etc. pada duplicate slugs
- **Validation:** Test with duplicate titles

### 5.4 Testing & Documentation Requirements

#### TEST-1: Automated Testing
- **Minimum Coverage:**
  - Auth login/logout (Feature test)
  - Contact form submission + validation (Feature test)
  - Admin CRUD for projects (Feature test)
  - 404 fallback route (Feature test)
- **Target Coverage:** ≥ 70% for critical paths
- **CI Integration:** Tests run on every push before merge

#### DOC-1: Documentation
- **Update README.md** dengan setup instructions, deployment guide
- **Add SECURITY.md** untuk reporting vulnerabilities
- **Add DEPLOYMENT.md** untuk detailed deploy workflow
- **API Documentation:** Optional (tidak ada public API saat ini)

---

## 6. User Stories & Acceptance Criteria

### Story 1: Disable Admin Registration
```
AS A: DevOps/Admin
I WANT TO: Prevent unauthorized admin account creation
SO THAT: Only authorized admins can access CMS

ACCEPTANCE CRITERIA:
- [ ] /admin/register route does not exist (404)
- [ ] GET /admin/register returns 404
- ] POST /admin/register returns 404
- [ ] Admin login page does NOT show "Register here" link
- [ ] Only existing admins can login
- [ ] Audit finds exactly 1 admin account in production
```

### Story 2: Secure Deployment Workflow
```
AS A: DevOps Engineer
I WANT TO: Deploy safely with build steps & exclusions
SO THAT: App doesn't break, sensitive files aren't exposed

ACCEPTANCE CRITERIA:
- [ ] Workflow excludes: .git, node_modules, tests/, .env
- [ ] npm run build executes before deploy
- [ ] composer install --no-dev executes on server
- [ ] php artisan migrate runs without user intervention
- [ ] Storage symlink created automatically
- [ ] Config/route caching enabled
- [ ] No 500 errors post-deploy (health check passes)
- [ ] SSH key auth used (no passwords in YAML)
```

### Story 3: Rate Limiting on Critical Endpoints
```
AS A: Security Officer
I WANT TO: Protect login & contact from brute force/spam
SO THAT: Service is resilient to automated attacks

ACCEPTANCE CRITERIA:
- [ ] /admin/login returns 429 after 5 failed attempts/min
- [ ] POST /contact returns 429 after 5 requests/min
- [ ] IP-based throttling configured
- [ ] User sees friendly "too many requests" message
- [ ] Throttle key stored in cache/Redis (persistent)
```

### Story 4: Fix Email Sender Configuration
```
AS A: Admin
I WANT TO: Contact form emails deliver reliably
SO THAT: User inquiries reach my inbox consistently

ACCEPTANCE CRITERIA:
- [ ] Mail from address = configured app email (not user email)
- [ ] Reply-To = user email (so I can reply to them)
- [ ] CONTACT_MAIL_TO loaded from .env
- [ ] No hardcoded email in code
- [ ] SPF/DKIM aligned (check with mail provider)
```

### Story 5: 404 Error Page
```
AS A: User
I WANT TO: See friendly 404 page for invalid URLs
SO THAT: I know the page doesn't exist (not 500 error)

ACCEPTANCE CRITERIA:
- [ ] /invalid-url returns 404 (not 500)
- [ ] resources/views/errors/404.blade.php exists
- [ ] 404 page matches site design/branding
- [ ] Contains "Home" link back to portfolio
```

---

## 7. Technical Architecture (High Level)

### Deployment Architecture

```
GitHub Push
    ↓
[GitHub Actions] ← CI/CD Pipeline
    ├─ Run Tests
    ├─ Run Linting
    ├─ Build (npm run build)
    └─ Trigger Deploy
    ↓
[SSH/SFTP to cPanel]
    ├─ Sync files (with exclusions)
    ├─ Install dependencies (composer/npm)
    ├─ Run migrations
    ├─ Cache configuration
    └─ Verify health
    ↓
[Production Server - Laravel App]
    ├─ Web root: /home/user/public_html
    ├─ App root: /home/user/app (outside webroot)
    ├─ Storage: symlink to /home/user/storage
    └─ .env: managed directly on server
```

### Security Architecture

```
[Admin]
    ↓
[Login with Rate Limit] ← 5 req/min per IP
    ↓
[Session (encrypted)]
    ↓
[Admin Panel]
    ├─ Create/Edit Projects (upload to Storage, slug validation)
    ├─ Create/Edit Personal Projects (XSS escaped)
    └─ View Service (route protected if enabled)

[Public User]
    ↓
[Contact Form with Rate Limit] ← 5 req/min per IP
    ↓
[Email: from=app, replyTo=user, to=CONTACT_MAIL_TO]
```

---

## 8. Dependencies & Tech Stack

### Required Technologies
- **Framework:** Laravel 12 (already in use)
- **Language:** PHP 8.2+
- **Frontend Build:** Vite (already configured)
- **Deployment:** GitHub Actions + cPanel SFTP
- **Cache:** Redis or File (for rate limiting)

### Required Dependencies (PHP)
- `laravel/framework:^12.0` ✓
- `laravel/tinker` (for admin setup) ✓
- `laravel/pint` (code linting) ✓
- Optional: `mews/purifier` (HTML sanitization, if needed)

### Optional Tools
- GitHub Actions Matrix (multi-environment testing)
- SonarQube or Scrutinizer (code quality)
- New Relic / Sentry (error monitoring)

---

## 9. Release Plan

### Phase 1: Critical Security (Week 1 - URGENT)
**Goal:** Make app safe for production

| Task | Owner | Days | Dependency |
|------|-------|------|------------|
| Disable `/admin/register` | Backend | 0.5d | — |
| Create 404 error view | Frontend | 0.5d | — |
| Audit `users` table in prod | DevOps | 0.5d | Phase 1.1 complete |
| Update deploy workflow (build + exclude) | DevOps | 2d | — |
| Add rate limiting (login + contact) | Backend | 1d | — |
| Fix email config (from/replyTo) | Backend | 0.5d | — |
| Hardened `.env` template | DevOps | 0.5d | — |

**Deliverables:**
- ✅ Updated GitHub Actions workflow
- ✅ Deployment guide (DEPLOYMENT.md)
- ✅ Security checklist (SECURITY.md)

### Phase 2: High-Priority Fixes (Week 2)
**Goal:** Clean up code, prepare for long-term maintenance

| Task | Owner | Days |
|------|-------|------|
| Service CRUD: decide (implement or remove) | Backend | 1d |
| Fix XSS in personal project | Backend | 0.5d |
| Unify upload strategy | Backend | 1d |
| Fix slug collision | Backend | 1d |
| Add basic feature tests (auth, contact, 404) | QA/Backend | 2d |
| Update README.md | Docs | 0.5d |

**Deliverables:**
- ✅ Test suite with ≥ 70% coverage
- ✅ Updated README & docs

### Phase 3: Refactoring & Long-term (Backlog)
- [ ] Refactor monolith views to components
- [ ] Add comprehensive integration tests
- [ ] Rich HTML editor (if needed)
- [ ] Infrastructure as Code

---

## 10. Risk Assessment

| Risk | Probability | Impact | Mitigation |
|------|-------------|--------|-----------|
| Regressions during deploy | Medium | High | Comprehensive test suite + staging env |
| Admin route removal breaks custom code | Low | Medium | Grep entire codebase for /admin/register references |
| Storage symlink fails on deploy | Low | High | Include validation step in post-deploy script |
| Rate limiter cache expires | Low | Medium | Use persistent cache backend (Redis) |
| Email deliverability issues | Medium | Medium | Test with mail service provider, validate SPF/DKIM |
| Build process time impacts deploy | Medium | Low | Cache npm/composer dependencies in GitHub Actions |

---

## 11. Success Criteria (Go/No-Go)

### Go to Production ✅
- [ ] 0 critical security findings
- [ ] All Phase 1 tasks complete
- [ ] Automated tests passing (100% of critical paths)
- [ ] Deploy workflow tested 2x successfully
- [ ] Admin account audit completed
- [ ] Security checklist signed off
- [ ] Load test passed (if traffic expected > 1K/day)

### No-Go 🚫
- [ ] Any unresolved critical issue remains
- [ ] Deploy workflow fails on test run
- [ ] Tests coverage < 60% for auth
- [ ] Performance regression detected

---

## 12. Approval & Sign-off

| Role | Name | Signature | Date |
|------|------|-----------|------|
| Product Owner | — | — | — |
| Tech Lead | — | — | — |
| DevOps Lead | — | — | — |
| Security Lead | — | — | — |

---

## Appendix: Reference Links

- **OWASP Top 10:** https://owasp.org/www-project-top-ten/
- **Laravel Security:** https://laravel.com/docs/12.x/security
- **Laravel Rate Limiting:** https://laravel.com/docs/12.x/rate-limiting
- **Laravel Deployment:** https://laravel.com/docs/12.x/deployment
- **GitHub Actions for Laravel:** https://github.com/marketplace?type=actions&query=laravel
- **cPanel Best Practices:** https://docs.cpanel.net/knowledge-base/

---

**Document Version:** 1.0  
**Last Updated:** 6 Juli 2026  
**Next Review:** Post-Phase 1 completion
