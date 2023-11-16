<?php

namespace Modules\Hub\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Hub\App\Models\Product;
use Modules\Hub\App\Observers\ProductObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        ### Eloquent
        Product::observe(ProductObserver::class);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
