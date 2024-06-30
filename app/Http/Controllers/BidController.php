<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidController extends Controller
{
    public function placeBid(Request $request, $auctionId)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:0.01',
        ]);

        $auction = Auction::findOrFail($auctionId);

        $bid = new Bid();
        $bid->auction_id = $auction->id;
        $bid->user_id = auth()->user()->id; // Assuming authenticated user
        $bid->amount = $request->input('bid_amount');
        $bid->save();

        // Optionally, update the auction's highest bid reference
        if ($bid->amount > $auction->highest_bid_amount) {
            $auction->highest_bid_id = $bid->id;
            $auction->save();
        }

        return redirect()->back()->with('success', 'Your bid has been placed successfully.');
    }
}
