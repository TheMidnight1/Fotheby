<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'AuctionCategory');
    }
}
