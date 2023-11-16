<?php

namespace Modules\Hub\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Hub\App\Repositories\Contracts\OfferRepository;
use Modules\Hub\App\Repositories\Contracts\ProductRepository;
use Modules\Hub\App\Repositories\Contracts\RelationRepository;
use Modules\Hub\App\Repositories\Eloquent\OfferRepositoryEloquent;
use Modules\Hub\App\Repositories\Eloquent\ProductRepositoryEloquent;
use Modules\Hub\App\Repositories\Eloquent\RelationRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(OfferRepository::class, OfferRepositoryEloquent::class);
        $this->app->bind(RelationRepository::class, RelationRepositoryEloquent::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
