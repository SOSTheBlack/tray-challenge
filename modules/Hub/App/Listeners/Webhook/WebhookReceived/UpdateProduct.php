<?php

namespace Modules\Hub\App\Listeners\Webhook\WebhookReceived;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Repositories\Contracts\ProductRepository;
use Modules\Hub\App\Repositories\Datas\Enums\ProductStatusEnum;
use Modules\Hub\App\Repositories\Datas\ProductData;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductPlatformData;
use Throwable;

class UpdateProduct implements ShouldQueue
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
            $productHub = $event->getProductHubData();

            $this->updateProduct($productApi, $productHub);
        } catch (Throwable $exception) {
            Log::error(message: $exception->getMessage(), context: $exception->getTrace());

            $event->continue = false;
        } finally {
            return $event->continue;
        }
    }

    /**
     * @param ProductPlatformData $productApi
     * @param ProductData $productHub
     *
     * @return void
     *
     * @throws Throwable
     */
    private function updateProduct(ProductPlatformData $productApi, ProductData $productHub): void
    {
        $structureNewProduct = $this->structureNewProduct($productApi, $productHub);

        $this->productRepository->updateOrFail(
            $structureNewProduct->toArray(),
            $productHub->id
        );
    }

    /**
     * @param ProductPlatformData $productApi
     * @param ProductData $productHub
     *
     * @return ProductData
     */
    private function structureNewProduct(ProductPlatformData $productApi, ProductData $productHub): ProductData
    {
        $productHub->title = $productApi->title;
        $productHub->status = $this->defineStatus($productApi->status);
        $productHub->price = $productApi->price;
        $productHub->promotional_price = $productApi->price;
        $productHub->quantity = $productApi->quantity;

        return $productHub;
    }

    /**
     * @param ProductStatusEnum $productData
     *
     * @return ProductStatusEnum
     */
    private function defineStatus(string $productData): ProductStatusEnum
    {
        $productStatus = $productData;

        return ProductStatusEnum::from($productStatus);
    }
}
