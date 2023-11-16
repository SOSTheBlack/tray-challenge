<?php

namespace Modules\Hub\App\Events;

use Cache;
use Illuminate\Queue\SerializesModels;
use Modules\Hub\App\Http\Requests\Webhooks\WebhookData;
use Modules\Hub\App\Repositories\Datas\ProductData;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductPlatformData;
use Psr\SimpleCache\InvalidArgumentException;
use Spatie\LaravelData\DataCollection;

class WebhookReceivedEvent
{
    use SerializesModels;

    public bool $continue = true;

    /**
     * @var WebhookData
     */
    private WebhookData $webhookData;

    /**
     * @var ProductPlatformData
     */
    private ProductPlatformData $productApiData;

    /**
     * @var ProductData
     */
    private ProductData $productHubData;

    /**
     * @var DataCollection
     */
    private DataCollection $relationsHubDataCollection;

    /**
     * Create a new event instance.
     */
    public function __construct(WebhookData $webhookData)
    {
        $this->webhookData = $webhookData;
    }

    /**
     * @return WebhookData
     */
    public function getWebhookData(): WebhookData
    {
        return $this->webhookData;
    }

    /**
     * @return ProductPlatformData
     */
    public function getProductApiData(): ProductPlatformData
    {
        return $this->productApiData ?? Cache::get('productApiData');
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setProductApiData(ProductPlatformData $productApiData): WebhookReceivedEvent
    {
        $this->productApiData = $productApiData;

        Cache::set('productApiData', $this->productApiData);

        return $this;
    }

    /**
     * @return ProductData
     */
    public function getProductHubData(): ProductData
    {
        return $this->productHubData ?? Cache::get('productHubData');
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setProductHubData(ProductData $productHubData): WebhookReceivedEvent
    {
        $this->productHubData = $productHubData;

        Cache::set('productHubData', $this->productHubData);

        return $this;
    }

    /**
     * @return DataCollection
     */
    public function getRelationsHubDataCollection(): DataCollection
    {
        return $this->relationsHubDataCollection ?? Cache::get('relationsHubDataCollection');
    }

    /**
     * @param DataCollection $relationsHubDataCollection
     *
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function setRelationsHubDataCollection(DataCollection $relationsHubDataCollection): WebhookReceivedEvent
    {
        $this->relationsHubDataCollection = $relationsHubDataCollection;

        Cache::set('relationsHubDataCollection', $this->relationsHubDataCollection);

        return $this;
    }
}
