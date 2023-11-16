<?php

namespace Modules\Hub\App\Services\Platforms\Resources;

use Illuminate\Http\Client\RequestException;
use Modules\Hub\App\Services\Platforms\Contracts\Resources\WebhookEndpoint;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductWebhookPlatformData;
use Modules\Hub\App\Services\Platforms\Platform;

final readonly class WebhookResource implements WebhookEndpoint
{
    /**
     * @var ProductWebhookPlatformData
     */
    private ProductWebhookPlatformData $data;

    /**
     * @param Platform $platformService
     */
    public function __construct(private readonly Platform $platformService)
    {
    }

    /**
     * @param int $reference
     *
     * @return void
     *
     * @throws RequestException
     */
    public function send(int $reference): void
    {
        $this->platformService->api
            ->post(
                url: $this->platformService::BASE_URL . self::ENDPOINT_WEBHOOK,
                data: $this->data->toArray()
            )
            ->throw()
            ->object();
    }

    /**
     * @param ProductWebhookPlatformData $structureData
     *
     * @return WebhookEndpoint
     */
    public function setData(ProductWebhookPlatformData $structureData): WebhookEndpoint
    {
        $this->data = $structureData;

        return $this;
    }
}
