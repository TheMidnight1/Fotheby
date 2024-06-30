@extends('frontend.layouts.master')

@section('title', 'Home Page')

@section('content')
<style>
    .lot-card {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .lot-card img {
        max-width: 100%;
        height: auto;
    }

    .sold-badge {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>CLOSURE DATE: JUNE 16, 2024, 22:00 GMT+0545 (NEPAL TIME)</h6>
                </div>
                <div>
                    <span>Prices in NPR</span> | <span>English (United States)</span>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mx-1">All Lots</button>
                <a href="/login">

                    <button class="btn btn-success mx-1">Login to add items</button>
                </a>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between">
                <span>Category: All Categories</span>
                <span>Lots in auction: {{ $auctions->count() }}</span>
            </div>
        </div>
    </div>

    @foreach ($auctions as $auction)
    <div class="row lot-card">
        <div class="col-md-3">
            <img src="{{ asset('storage/' . $auction->image) }}" alt="Lot {{ $auction->LotNumber }}">
        </div>
        <div class="col-md-9">
            <h5>{{ $auction->Title }}</h5>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span>Current price</span>
                    <h6>NPR {{ number_format($auction->EstimatedPrice, 2) }}</h6>
                </div>
                <div>
                    <span>Artist Name</span>
                    <h6>{{ $auction->ArtistName }}</h6>
                </div>
                <div>
                    <span>Lot</span>
                    <h6>{{ $auction->LotNumber }}</h6>
                </div>
            </div>
            <p>{{ $auction->Description }}</p>
            @guest
            <a href='/login'>

                <button class="btn btn-primary">Login to bid</button>
            </a>
            @endguest
            @auth
            <a href="{{ route('auction.show', $auction->id) }}" class="btn btn-success">
              View lot
            </a>

            @endauth

            <!-- <span class="sold-badge">SOLD FOR</span> -->
        </div>
    </div>
    @endforeach
</div>
@endsection