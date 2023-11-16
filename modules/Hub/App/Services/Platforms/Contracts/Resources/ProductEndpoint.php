<?php

namespace Modules\Hub\App\Services\Platforms\Contracts\Resources;

use Illuminate\Http\Client\RequestException;
use Modules\Hub\App\Services\Platforms\Data\Products\ProductPlatformData;

interface ProductEndpoint
{
    public const ENDPOINT_FIND_BY_REF = '/products/%u';

    /**
     * @param int $reference
     *
     * @return ProductPlatformData
     *
     * @throws RequestException
     */
    public function find(int $reference): ProductPlatformData;
}
