<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::enforceMorphMap([
            'Meat Establishment' => \App\Models\MeatEstablishment::class,
            'MTV Operator' => \App\Models\MtvOperator::class,
            'MTV Vehicle' => \App\Models\MtvVehicle::class,
        ]);
    }
}
