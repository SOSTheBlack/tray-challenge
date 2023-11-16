<?php

namespace Modules\Hub\App\Services\Platforms;

use Illuminate\Http\Client\PendingRequest;
use Modules\Hub\App\Services\Platforms\Contracts\PlatformService;
use Modules\Hub\App\Services\Platforms\Contracts\Resources\ProductEndpoint;
use Modules\Hub\App\Services\Platforms\Contracts\Resources\WebhookEndpoint;
use Modules\Hub\App\Services\Platforms\Resources\ProductResource;
use Modules\Hub\App\Services\Platforms\Resources\WebhookResource;

final class Platform implements PlatformService
{
    /**
     * @param PendingRequest $api
     */
    public function __construct(public PendingRequest $api)
    {
    }

    /**
     * @return ProductEndpoint
     */
    public function products(): ProductEndpoint
    {
        return new ProductResource($this);
    }

    /**
     * @return WebhookEndpoint
     */
    public function webhook(): WebhookEndpoint
    {
        return new WebhookResource($this);
    }
}
