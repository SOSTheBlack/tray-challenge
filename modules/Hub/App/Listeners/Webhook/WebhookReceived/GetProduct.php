<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Repositories\Contracts\ProductRepository;
use Throwable;

class GetProduct implements ShouldQueue
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
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceivedEvent $event): bool
    {
        try {
            $productApi = $event->getProductApiData();

            $product = $this->productRepository->findFirstByFieldOrFail(
                field: 'reference',
                value: $productApi->reference
            );

            $event->setProductHubData($product);
        } catch (Throwable $exception) {
//            dd($exception);
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }
}
