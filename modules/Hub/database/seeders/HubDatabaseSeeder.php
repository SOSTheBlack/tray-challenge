<?php

namespace Modules\Hub\database\seeders;

use Illuminate\Database\Seeder;

class HubDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            OfferSeeder::class,
            RelationSeeder::class
        ]);
    }
}
