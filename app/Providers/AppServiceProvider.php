<?php

namespace App\Providers;

use App\Models\MilitaryOrganization;
use App\Models\RoleUser;
use App\Models\User;
use App\Observers\MilitaryOrganizationObserver;
use App\Observers\RoleUserObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MilitaryOrganization::observe(MilitaryOrganizationObserver::class);
        User::observe(UserObserver::class);
        RoleUser::observe(RoleUserObserver::class);
    }
}
