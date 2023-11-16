<?php

namespace Modules\Hub\App\Services\Platforms\Data\Products;

use Spatie\LaravelData\Data;

class ProductPlatformData extends Data
{
    /**
     * @var string
     */
    public string $reference;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $status;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var int
     */
    public int $quantity;
}
