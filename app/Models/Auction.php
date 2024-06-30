<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'LotNumber',
        'Title',
        'Description',
        'ArtistName',
        'BuiltYear',
        'AuctionDate',
        'EstimatedPrice',
        'AuctionCategory',
        'image',
        'height',
        'width',
        'weight',
        'Frame'
    ];

    public function category()
    {
        return $this->belongsTo(AuctionCategory::class, 'AuctionCategory');
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function highestBid()
    {
        return $this->hasOne(Bid::class)->latest();
    }

    public function getHighestBidAmountAttribute()
    {
        $highestBid = $this->highestBid;
        return $highestBid ? $highestBid->amount : null;
    }
}
