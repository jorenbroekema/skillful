<?php

namespace App\Providers;

use App\User;
use App\Workshop;
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
        'App\Workshop' => 'App\Policies\WorkshopPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            return $user->isSuperUser();
        });

        // Whether user is allowed to participate or unlist from a given workshop
        // TODO: In the future, probably will be 'request to join' as well as adding something so that owners and
        // moderators can kick people from the participation list.
        Gate::define('participating', function (User $user, Workshop $workshop) {
            if ($workshop->public || $workshop->sharesGroupWith($user, true)) {
                return true;
            }
            return false;
        });
    }
}
