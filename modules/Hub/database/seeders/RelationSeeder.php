<?php

namespace Modules\Hub\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Hub\App\Models\Relation;

class RelationSeeder extends Seeder
{
    /**
     * @var array|\int[][]
     */
    private array $data = [
        [
            'product_id' => 1,
            'offer_id' => 1,
        ],
        [
            'product_id' => 1,
            'offer_id' => 2,
        ],
        [
            'product_id' => 2,
            'offer_id' => 3,
        ],
        [
            'product_id' => 3,
            'offer_id' => 4,
        ]
    ];

    /**
     * @param Relation $relation
     */
    public function __construct(private readonly Relation $relation)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect($this->data)->each(function (array $relationData): void {
            $this->relation->updateOrCreate($relationData, $relationData);
        });
    }
}
