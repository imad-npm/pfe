<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        RateLimiter::for('login',function ($request) {
            return Limit::perMinutes(1,5)->by($request->ip) ;
        }) ;

        RateLimiter::for('register',function ($request) {
            return Limit::perMinutes(5,5)->by($request->ip) ;
        }) ;

        RateLimiter::for('resend-email',function ($request) {
            return Limit::perMinutes(1,3)->by($request->ip) ;
        }) ;

        RateLimiter::for('reset-password',function ($request) {
            return Limit::perMinutes(1,3)->by($request->ip) ;
        }) ;

        RateLimiter::for('contact',function ($request) {
            return Limit::perMinutes(5,3)->by($request->ip) ;
        }) ;
    }
}
