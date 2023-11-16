<?php

namespace Modules\Hub\App\Services\Platforms\Contracts\Resources;

use Illuminate\Http\Client\RequestException;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductWebhookPlatformData;

interface WebhookEndpoint
{
    public const ENDPOINT_WEBHOOK = '/webhook';

    /**
     * @param int $reference
     *
     * @return void
     *
     * @throws RequestException
     */
    public function send(int $reference): void;

    /**
     * @param ProductWebhookPlatformData $structureData
     *
     * @return WebhookEndpoint
     */
    public function setData(ProductWebhookPlatformData $structureData): WebhookEndpoint;
}
