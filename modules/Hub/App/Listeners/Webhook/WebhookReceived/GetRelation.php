<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Repositories\Contracts\RelationRepository;
use Spatie\LaravelData\DataCollection;
use Throwable;

class GetRelation implements ShouldQueue
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
    public function __construct(private readonly RelationRepository $relationRepository)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceivedEvent $event): bool
    {
        try {
            $productHub = $event->getProductHubData();

            /** @var DataCollection $relations */
            $relations = $this->relationRepository->findByField(
                field: 'product_id',
                value: $productHub->id
            );

            $event->setRelationsHubDataCollection($relations);
        } catch (Throwable $exception) {
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }
}
