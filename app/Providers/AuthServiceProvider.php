<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Filament\Facades\Filament;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Filament::serving(function () {
            if (auth()->check() && !auth()->user()->isActive()) {
                auth()->logout();
                session()->flash('error', 'Akses ditolak! Akun Anda tidak aktif. Silakan hubungi administrator.');
                redirect('/admin/login')->send();
            }
        });
    }
}
