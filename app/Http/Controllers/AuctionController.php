<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionCategory;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();
        return view('frontend.layouts.index', compact('auctions'));
    }

    public function show($id)
        {
            $auction = Auction::findOrFail($id);
            return view('frontend.auction.show', compact('auction'));
        }

    public function create()
    {
        $categories = AuctionCategory::all();
        return view('frontend.auction.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'LotNumber' => 'required',
            'Title' => 'required',
            'Description' => 'required',
            'ArtistName' => 'required',
            'BuiltYear' => 'required|integer',
            'AuctionDate' => 'required|date',
            'EstimatedPrice' => 'required|numeric',
            'AuctionCategory' => 'required|exists:auction_categories,id',
            'image' => 'nullable|image',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'weight' => 'required|numeric',
            'Frame' => 'required|boolean'
        ]);

        $auction = new Auction($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $auction->image = $path;
        }

        $auction->save();

        return redirect()->route('homepage')->with('success', 'Auction item added successfully!');
    }

    public function edit($id)
{
    $auction = Auction::findOrFail($id);
    $categories = AuctionCategory::all();
    return view('frontend.auction.edit', compact('auction', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'LotNumber' => 'required',
        'Title' => 'required',
        'Description' => 'required',
        'ArtistName' => 'required',
        'BuiltYear' => 'required|integer',
        'AuctionDate' => 'required|date',
        'EstimatedPrice' => 'required|numeric',
        'AuctionCategory' => 'required|exists:auction_categories,id',
        'height' => 'required|numeric',
        'width' => 'required|numeric',
        'weight' => 'required|numeric',
        'Frame' => 'required|boolean',
        'image' => 'image|nullable',
    ]);

    $auction = Auction::findOrFail($id);
    $auction->LotNumber = $request->LotNumber;
    $auction->Title = $request->Title;
    $auction->Description = $request->Description;
    $auction->ArtistName = $request->ArtistName;
    $auction->BuiltYear = $request->BuiltYear;
    $auction->AuctionDate = $request->AuctionDate;
    $auction->EstimatedPrice = $request->EstimatedPrice;
    $auction->AuctionCategory = $request->AuctionCategory;
    $auction->height = $request->height;
    $auction->width = $request->width;
    $auction->weight = $request->weight;
    $auction->Frame = $request->Frame;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $auction->image = $path;
    }

    $auction->save();

    return redirect()->route('homepage')->with('success', 'Auction item updated successfully.');
}

}
