<?php

namespace App\Providers;

use App\Models\Outbound;
use App\Models\Shipment;
use App\Observers\OutboundObserver;
use App\Observers\ShipmentObserver;
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
        Outbound::observe(OutboundObserver::class);
        Shipment::observe(ShipmentObserver::class);
    }
}
