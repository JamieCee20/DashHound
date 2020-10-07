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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('manage-users', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator', 'moderator']);
        });

        Gate::define('edit-users', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator', 'moderator']);
        });

        Gate::define('delete-users', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator']);
        });

        Gate::define('post-verified-create', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator', 'verified']);
        });

        Gate::define('pinned-post', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator']);
        });

        Gate::define('forum-admin', function($user) {
            return $user->hasAnyRoles(['owner', 'administrator', 'moderator']);
        });
    }
}
