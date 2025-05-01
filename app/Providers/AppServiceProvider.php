<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengecek role pengguna sebelum memuat Filament
        Filament::serving(function () {
            if (Auth::check()) {
                $user = Auth::user();

                // Hanya izinkan akses ke dashboard jika role_id = 1 (admin)
                if ($user->role_id != 1) {
                    return redirect('/')->send();
                }
            }
        });
    }
}
