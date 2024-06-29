<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('auctions')->insert([
            [
                'LotNumber' => '001',
                'Title' => 'Sunset Over the Ocean',
                'Description' => 'A beautiful painting of a sunset over the ocean.',
                'ArtistName' => 'John Doe',
                'BuiltYear' => 2020,
                'AuctionDate' => '2024-07-15',
                'EstimatedPrice' => 1500.00,
                'AuctionCategory' => 2, // Paintings
                'image' => 'images/sunset.jpg',
                'height' => 24.00,
                'width' => 36.00,
                'weight' => 5.50,
                'Frame' => true
            ],
            // Add more auction items here
        ]);
    }
}
