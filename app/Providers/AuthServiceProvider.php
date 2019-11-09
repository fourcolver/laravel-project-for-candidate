<?php

namespace App\Providers;

use App\EmployeePermission;
use App\User;
use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('customers-create', function (User $user) {
            $ability = true;
            if(!$user->isAdmin) {
                $ability = in_array('add', explode(',', currentPermissions()->kunden_permission));
            }
            return $ability;
        });

        Gate::define('freelancers-list', function (User $user) {
            $ability = true;
            if(!$user->isAdmin) {
                $ability = in_array('all', explode(',', currentPermissions()->kandidaten_permission));
            }
            return $ability;
        });

        Gate::define('candidates-list', function (User $user) {
            $ability = true;
            if(!$user->isAdmin) {
                $ability = in_array('all', explode(',', currentPermissions()->festanstellung_permission));
            }
            return $ability;
        });

        Gate::define('employees-list', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('documents-list', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('upload-csv', function (User $user) {
            return $user->isAdmin;
        });

        Gate::define('project-inquires-create', function (User $user) {
            $ability = true;
            if(!$user->isAdmin) {
                $ability = in_array('all', explode(',', currentPermissions()->projektanfrage_permission));
            }
            return $ability;
        });

        Gate::define('managers-create', function (User $user) {
            $ability = true;
            if(!$user->isAdmin) {
                $ability = in_array('all', explode(',', currentPermissions()->knotakte_permission));
            }
            return $ability;
        });
    }
}
