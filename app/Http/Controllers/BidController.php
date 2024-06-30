<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function placeBid(Request $request, $auctionId)
    {
        $user = Auth::user();
        $auction = Auction::findOrFail($auctionId);

        if ($auction->expiry_date && Carbon::now()->greaterThan($auction->expiry_date)) {
            return redirect()->back()->with('message', 'This auction has expired.');
        }

        $request->validate([
            'bid_amount' => ['required', 'numeric', 'min:' . $auction->EstimatedPrice],
        ]);

        $amount = $request->input('bid_amount');

        // Check if the user has already placed a bid on this auction
        $existingBid = Bid::where('auction_id', $auctionId)
                          ->where('user_id', $user->id)
                          ->first();

        if ($existingBid) {
            // Update the existing bid
            $existingBid->amount = $amount;
            $existingBid->updated_at = now();
            $existingBid->save();

            return redirect()->back()->with('message', 'Your bid has been updated successfully.');
        }

        // Insert the new bid
        $bid = new Bid();
        $bid->auction_id = $auctionId;
        $bid->user_id = $user->id;
        $bid->amount = $amount;
        $bid->created_at = now();
        $bid->updated_at = now();
        $bid->save();

        return redirect()->back()->with('message', 'Bid placed successfully.');
    }

}
