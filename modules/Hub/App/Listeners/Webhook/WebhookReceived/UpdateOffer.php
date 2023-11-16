<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Repositories\Contracts\OfferRepository;
use Modules\Hub\App\Repositories\Datas\Enums\OfferStatusEnum;
use Modules\Hub\App\Repositories\Datas\OfferData;
use Modules\Hub\App\Repositories\Datas\ProductData;
use Modules\Hub\App\Repositories\Datas\RelationData;
use Spatie\LaravelData\DataCollection;
use Throwable;

class UpdateOffer implements ShouldQueue
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
    public function __construct(private readonly OfferRepository $offerRepository)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceivedEvent $event): bool
    {
        try {
            $relations = $event->getRelationsHubDataCollection();
            $product = $event->getProductHubData();

            $this->updateOfferOfProduct($relations, $product);
        } catch (Throwable $exception) {
            dd($exception);
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }

    /**
     * @param DataCollection $relations
     * @param ProductData $product
     *
     * @return void
     */
    private function updateOfferOfProduct(DataCollection $relations, ProductData $product): void
    {
        $relations->each(callback: function (RelationData $relationData) use ($product): void {
            $offer = $this->getOffer($relationData);
            $structureNewOffer = $this->structureNewOffer($offer, $product);

            $this->offerRepository->updateOrFail(
                attributes: $structureNewOffer->toArray(),
                id: $offer->id
            );
        });
    }

    /**
     * @param RelationData $relationData
     *
     * @return OfferData
     */
    private function getOffer(RelationData $relationData): OfferData
    {
        return $this->offerRepository->findOrFail($relationData->offer_id);
    }

    /**
     * @param OfferData $offer
     * @param ProductData $product
     *
     * @return OfferData
     */
    private function structureNewOffer(OfferData $offer, ProductData $product): OfferData
    {
        $offer->status = $this->defineStatus($product);
        $offer->price = $product->price;
        $offer->sale_price = $product->promotional_price;
        $offer->sale_starts_on = $product->promotion_starts_on;
        $offer->sale_ends_on = $product->promotion_ends_on;
        $offer->stock = $product->quantity;

        return $offer->only('status',
            'price',
            'sale_price',
            'sale_starts_on',
            'sale_ends_on',
            'stock'
        );
    }

    /**
     * @param ProductData $productData
     *
     * @return OfferStatusEnum
     */
    private function defineStatus(ProductData $productData): OfferStatusEnum
    {
        $productStatus = $productData->status->name === 'inactive' ? 'paused' : $productData->status->value;

        return OfferStatusEnum::from($productStatus);

    }
}
