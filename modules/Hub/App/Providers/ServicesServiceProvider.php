<?php

namespace Modules\Hub\App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Modules\Hub\App\Services\Platforms\Contracts\PlatformService;
use Modules\Hub\App\Services\Platforms\Platform;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton(PlatformService::class, function () {
            $client = Http::withOptions([
                'base_uri' => PlatformService::BASE_URL,
            ])->baseUrl(PlatformService::BASE_URL);

            return new Platform($client);
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
