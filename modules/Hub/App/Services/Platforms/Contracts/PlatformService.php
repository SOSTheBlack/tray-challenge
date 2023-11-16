<?php

namespace Modules\Hub\App\Services\Platforms\Contracts;

use Modules\Hub\App\Services\Platforms\Contracts\Resources\ProductEndpoint;
use Modules\Hub\App\Services\Platforms\Contracts\Resources\WebhookEndpoint;

interface PlatformService
{
    public const BASE_URL = 'https://demo8880419.mockable.io';

    /**
     * @return ProductEndpoint
     */
    public function products(): ProductEndpoint;

    /**
     * @return WebhookEndpoint
     */
    public function webhook(): WebhookEndpoint;
}
