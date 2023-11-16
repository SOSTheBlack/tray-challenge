<?php

namespace Modules\Hub\App\Repositories\Eloquent;

use Modules\Hub\App\Models\Relation;
use Modules\Hub\App\Repositories\Contracts\RelationRepository;
use Modules\Hub\App\Repositories\Datas\RelationData;
use Spatie\LaravelData\Data;

final class RelationRepositoryEloquent extends BaseRepositoryEloquent implements RelationRepository
{
    /**
     * @var Data|string|null
     */
    protected Data|string|null $data = RelationData::class;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Relation::class;
    }
}
