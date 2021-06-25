<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
    // 管理者のみ許可
    Gate::define('admin', function ($user) {
        return $user->role === 100;
    });

    // 店舗代表者のみ許可
    Gate::define('owner', function ($user) {
        return $user->role === 50;
    });

    // ユーザーのみ許可
    Gate::define('user', function ($user) {
        return $user->role === 1;
    });
    }
}
