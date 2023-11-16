<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Http\Requests\Webhooks\WebhookData;
use Modules\Hub\App\Services\Platforms\Contracts\PlatformService;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductPlatformData;
use Throwable;

class GetProductInPlatform implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string
     */
    public string $queue = 'webhooks';

    public function __construct(private readonly PlatformService $platformService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceivedEvent $event): bool
    {
        try {
            $productApi = $this->getProductOfWebhook($event->getWebhookData());

            $event->setProductApiData($productApi);
        } catch (Throwable $exception) {
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }

    /**
     * @throws RequestException
     */
    private function getProductOfWebhook(WebhookData $webhookData): ProductPlatformData
    {
        return $this->platformService->products()->find($webhookData->product_ref);
    }
}
