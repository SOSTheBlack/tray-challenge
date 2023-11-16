<?php

namespace Modules\Hub\App\Services\Platforms\Resources;

use Illuminate\Http\Client\RequestException;
use Modules\Hub\App\Services\Platforms\Contracts\Resources\ProductEndpoint;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductPlatformData;
use Modules\Hub\App\Services\Platforms\Platform;

final readonly class ProductResource implements ProductEndpoint
{
    public function __construct(private readonly Platform $platformService)
    {
    }

    /**
     * @param int $reference
     *
     * @return ProductPlatformData
     *
     * @throws RequestException
     */
    public function find(int $reference): ProductPlatformData
    {
        $endpoint = vsprintf(format: self::ENDPOINT_FIND_BY_REF, values: [$reference]);

        $responseObject = $this->platformService->api
            ->get(url: $endpoint)
            ->throw()
            ->object();

        return ProductPlatformData::from($responseObject->data);
    }
}
