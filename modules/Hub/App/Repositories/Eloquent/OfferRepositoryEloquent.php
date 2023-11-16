<?php

namespace Modules\Hub\App\Repositories\Eloquent;

use Modules\Hub\App\Models\Offer;
use Modules\Hub\App\Repositories\Contracts\OfferRepository;
use Modules\Hub\App\Repositories\Datas\OfferData;
use Spatie\LaravelData\Data;

final class OfferRepositoryEloquent extends BaseRepositoryEloquent implements OfferRepository
{
    /**
     * @var Data|string|null
     */
    protected Data|string|null $data = OfferData::class;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Offer::class;
    }
}
