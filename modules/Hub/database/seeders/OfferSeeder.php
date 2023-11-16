<?php

namespace Modules\Hub\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Hub\App\Repositories\Contracts\OfferRepository;

class OfferSeeder extends Seeder
{
    /**
     * @var array|array[]
     */
    private array $data = [
        [
            'reference' => 'cra-001',
            'title' => 'Camiseta regata 100% algodão',
            'status' => 'active',
            'price' => 29.90,
            'sale_price' => 19.90,
            'sale_starts_on' => '2023-01-01 00:00:00',
            'sale_ends_on' => '2023-12-31 23:59:59',
            'stock' => 10,
        ],
        [
            'reference' => 'crvc-001',
            'title' => 'Camiseta regata várias cores',
            'status' => 'active',
            'price' => 29.90,
            'sale_price' => 19.90,
            'sale_starts_on' => '2023-01-01 00:00:00',
            'sale_ends_on' => '2023-12-31 23:59:59',
            'stock' => 10,
        ],
        [
            'reference' => 'cdrtu-001',
            'title' => 'Cropped de renda tamanho único',
            'status' => 'active',
            'price' => 29.90,
            'sale_price' => null,
            'sale_starts_on' => null,
            'sale_ends_on' => null,
            'stock' => 12,
        ],
        [
            'reference' => 'cjtu-001',
            'title' => 'Calça jeans tamanho único',
            'status' => 'paused',
            'price' => 299.99,
            'sale_price' => 249.90,
            'sale_starts_on' => '2023-01-01 00:00:00',
            'sale_ends_on' => '2023-12-31 23:59:59',
            'stock' => 5,
        ],
        [
            'reference' => 'bjtu-001',
            'title' => 'Bermuda jeans tamanho único',
            'status' => 'paused',
            'price' => 59.90,
            'sale_price' => null,
            'sale_starts_on' => null,
            'sale_ends_on' => null,
            'stock' => 0,
        ]
    ];

    /**
     * @param OfferRepository $offer
     */
    public function __construct(private readonly OfferRepository $offer)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect($this->data)->each(function (array $offerData) {
            $this->offer->updateOrCreate(
                $offerData,
                ['reference' => $offerData['reference']]
            );
        });
    }
}
