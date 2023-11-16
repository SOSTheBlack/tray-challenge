<?php

namespace Modules\Hub\App\Repositories\Datas;

use Carbon\Carbon;
use Modules\Hub\App\Repositories\Datas\Enums\OfferStatusEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OfferData extends Data
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
     * @var OfferStatusEnum
     */
    public OfferStatusEnum $status;

    /**
     * @var float
     */
    public float $price;

    /**
     * @var float|Optional
     */
    public float|Optional|null $sale_price;

    /**
     * @var string|null
     */
    public ?string $sale_starts_on = null;

    /**
     * @var string|null
     */
    public ?string $sale_ends_on = null;

    /**
     * @var int
     */
    public int $stock;

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
