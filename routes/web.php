<?php

use App\Http\Controllers\AuctionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.layouts.index');
// });


Route::get('/', [AuctionController::class, 'index'])->name('homepage');

Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auction.show');
Route::get('/auction/create', [AuctionController::class, 'create'])->name('auction.create');
Route::post('/auction/store', [AuctionController::class, 'store'])->name('auction.store');
Route::get('/auction/{id}/edit', [AuctionController::class, 'edit'])->name('auction.edit');
Route::post('/auction/{id}/update', [AuctionController::class, 'update'])->name('auction.update');

