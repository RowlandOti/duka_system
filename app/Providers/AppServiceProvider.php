<?php

namespace App\Providers;

use App\Customer;
use Illuminate\Support\ServiceProvider;
use Tenancy\Identification\Contracts\ResolvesTenants;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Laravel\Passport\Passport::ignoreMigrations();

        $this->app->resolving(ResolvesTenants::class, function (ResolvesTenants $resolver){
            $resolver->addModel(Customer::class);
            return $resolver;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
