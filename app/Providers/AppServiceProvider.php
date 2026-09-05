<?php

namespace App\Providers;

use App\Support\ProductionEnvGuard;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ProductionEnvGuard::assert([
            'env' => config('app.env'),
            'debug' => (bool) config('app.debug'),
            'allow_admin_registration' => (bool) config('app.allow_admin_registration'),
            'contact_to' => config('mail.contact.to'),
        ]);

        RateLimiter::for('admin-login', function (Request $request) {
            return Limit::perMinute(5)->by(
                strtolower((string) $request->input('email')).'|'.$request->ip()
            );
        });
    }
}
