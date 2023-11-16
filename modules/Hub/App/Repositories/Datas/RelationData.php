<?php

namespace Modules\Hub\App\Repositories\Datas;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class RelationData extends Data
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var int
     */
    public int $offer_id;

    /**
     * @var int
     */
    public int $product_id;

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
