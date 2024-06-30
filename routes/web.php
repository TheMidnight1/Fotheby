<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.layouts.listing');
// });

Route::get('/', [AuctionController::class, 'auctions'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/homepage', [AuctionController::class, 'index'])->name('homepage');

    Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auction.show');
    Route::get('/auction/create', [AuctionController::class, 'create'])->name('auction.create');
    Route::post('/auction/store', [AuctionController::class, 'store'])->name('auction.store');
    Route::get('/auction/{id}/edit', [AuctionController::class, 'edit'])->name('auction.edit');
    Route::post('/auction/{id}/update', [AuctionController::class, 'update'])->name('auction.update');
    Route::delete('/auction/{id}', [AuctionController::class, 'destroy'])->name('auction.destroy');


    Route::post('/auctions/{auctionId}/bid', [BidController::class, 'placeBid'])->name('bids.place');

});

require __DIR__ . '/auth.php';
