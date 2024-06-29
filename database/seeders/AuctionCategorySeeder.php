<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AuctionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('auction_categories')->insert([
            ['name' => 'Drawings', 'type' => 0],
            ['name' => 'Paintings', 'type' => 0],
            ['name' => 'Photographic Images', 'type' => 0],
            ['name' => 'Sculptures', 'type' => 0],
            ['name' => 'Cravings', 'type' => 0],
            ['name' => 'Pencil', 'type' => 1],
            ['name' => 'Ink', 'type' => 1],
            ['name' => 'Charcoal', 'type' => 1],
            ['name' => 'Oil', 'type' => 2],
            ['name' => 'Acrylic', 'type' => 2],
            ['name' => 'WaterColour', 'type' => 2],
            ['name' => 'Black and White', 'type' => 3],
            ['name' => 'Color', 'type' => 3],
            ['name' => 'Bronze', 'type' => 4],
            ['name' => 'Marble', 'type' => 4],
            ['name' => 'Pewter', 'type' => 4],
            ['name' => 'Oak', 'type' => 5],
            ['name' => 'Beach', 'type' => 5],
            ['name' => 'Pine', 'type' => 5],
            ['name' => 'Willow', 'type' => 5],
        ]);
    }
}
