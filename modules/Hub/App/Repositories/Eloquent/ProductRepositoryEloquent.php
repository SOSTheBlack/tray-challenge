<?php

namespace Modules\Hub\App\Repositories\Eloquent;

use Modules\Hub\App\Models\Product;
use Modules\Hub\App\Repositories\Contracts\ProductRepository;
use Modules\Hub\App\Repositories\Datas\ProductData;
use Spatie\LaravelData\Data;

class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepository
{
    /**
     * @var Data|string|null
     */
    protected Data|string|null $data = ProductData::class;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}
