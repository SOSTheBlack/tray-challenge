<?php

namespace Modules\Hub\App\Repositories\Datas;

use Carbon\Carbon;
use Modules\Hub\App\Repositories\Datas\Enums\ProductStatusEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProductData extends Data
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $reference;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var ProductStatusEnum
     */
    public ProductStatusEnum $status;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var float|Optional|null
     */
    public float|Optional|null $promotional_price;

    /**
     * @var string|Optional|null
     */
    public string|Optional|null $promotion_starts_on;

    /**
     * @var string|Optional|null
     */
    public string|Optional|null $promotion_ends_on;

    /**
     * @var int
     */
    public int $quantity;

    /**
     * @var Carbon
     */
    public Carbon $created_at;

    /**
     * @var Carbon
     */
    public Carbon $updated_at;

    /**
     * @var Carbon|null
     */
    public ?Carbon $deleted_at;
}
