<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductWebhookPlatformData;
use Modules\Hub\App\Services\Platforms\Platform;
use Throwable;

class SendWebhook implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string
     */
    public string $queue = 'webhooks';

    /**
     * Create the event listener.
     */
    public function __construct(private readonly Platform $platformService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceivedEvent $event): bool
    {
        try {
            $productApi = $event->getProductApiData();

            $structureData = ProductWebhookPlatformData::from($productApi->only('reference')->toArray());

            $this->platformService->webhook()
                ->setData($structureData)
                ->send($productApi->reference);

        } catch (Throwable $exception) {
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }
}
