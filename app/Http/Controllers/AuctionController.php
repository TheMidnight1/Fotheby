<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionCategory;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{

    public function auctions()
    {
        $user = Auth::user();

        if ($user) {

            $auctions = Auction::where('user_id', '!=', $user->id)->get();
        } else {
            $auctions = collect();  
        }
        $auction_if_no_auth = Auction::all();
        $currentTime = Carbon::now();

        foreach ($auction_if_no_auth as $auction) {
            $createdAt = Carbon::parse($auction->created_at);

            if ($createdAt->isSameDay($currentTime)) {
                // If it's the same day, check the time difference
                $timeDifference = $currentTime->diffInMinutes($createdAt);

                $auction->isNew = $timeDifference <= 1;
                $auction->isExpired = $timeDifference > 1;
            } else if ($createdAt->isBefore($currentTime)) {
                // If it's a previous day, it's expired
                $auction->isNew = false;
                $auction->isExpired = true;
            } else {
                // If it's a future day (shouldn't happen normally), consider it new
                $auction->isNew = true;
                $auction->isExpired = false;
            }
        }
        foreach ($auctions as $auction) {
            $createdAt = Carbon::parse($auction->created_at);

            if ($createdAt->isSameDay($currentTime)) {
                // If it's the same day, check the time difference
                $timeDifference = $currentTime->diffInMinutes($createdAt);

                $auction->isNew = $timeDifference <= 1;
                $auction->isExpired = $timeDifference > 1;
            } else if ($createdAt->isBefore($currentTime)) {
                // If it's a previous day, it's expired
                $auction->isNew = false;
                $auction->isExpired = true;
            } else {
                // If it's a future day (shouldn't happen normally), consider it new
                $auction->isNew = true;
                $auction->isExpired = false;
            }
        }

        return view('frontend.layouts.listing', compact('auctions', 'auction_if_no_auth'));
    }
    public function index()

    {
        $user = Auth::user();
        $auctions = Auction::where('user_id', $user->id)->get();
        $currentTime = Carbon::now();
        return view('frontend.layouts.index', compact('auctions', 'currentTime'));
    }

    public function show($auctionId)
    {
        $currentTime = Carbon::now();

        $user = Auth::user();

        $auction = Auction::findOrFail($auctionId);
        $createdAt = $auction->created_at;

        $createdAtDateTime = Carbon::parse($createdAt);

    
        // Check if the user has already placed a bid on this auction
        $existingBid = Bid::where('auction_id', $auctionId)
            ->where('user_id', $user->id)
            ->first();
    
        // Check if the auction has expired
        $isExpired = $createdAtDateTime->addMinutes(15)->isPast();
    
        // Get the final bid details if the auction is expired
        $finalBid = null;
        if ($isExpired) {
            $finalBid = Bid::where('auction_id', $auctionId)
                ->orderBy('amount', 'desc')
                ->first();
        }
    
        return view('frontend.auction.show', compact('auction', 'existingBid', 'isExpired', 'finalBid'));
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
        $auction->user_id = Auth::id();


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

    public function destroy($id)
    {
        $auction = Auction::findOrFail($id);

        // Delete the auction image if it exists
        if ($auction->image) {
            Storage::disk('public')->delete($auction->image);
        }

        $auction->delete();

        return redirect()->route('homepage')->with('success', 'Auction item deleted successfully.');
    }
}
