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

    .new-badge,
    .expired-badge {
        padding: 5px 10px;
        border-radius: 3px;
        color: white;
    }

    .new-badge {
        background-color: green;
    }

    .expired-badge {
        background-color: gray;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>My Items</h6>
                </div>

            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-center">
                <a href="{{ route('auction.create') }}">
                    <button class="btn btn-primary mx-1">Add Auction items</button>
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
            @php

            $createdAt = $auction->created_at;
            $createdAtDateTime = \Carbon\Carbon::parse($createdAt);

            @endphp

            @if ($createdAtDateTime->addMinutes(15)->isPast())
            <span class="expired-badge">EXPIRED</span>

            @else
            <span class="new-badge">NEW</span>
            @endif
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
            <form action="{{ route('auction.destroy', $auction->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETE THIS LOT</button>
            </form> <a href="{{ route('auction.edit', $auction->id) }}" class="btn btn-warning">EDIT THIS LOT</a>
            <!-- <span class="sold-badge">SOLD FOR</span> -->
        </div>
    </div>
    @endforeach
</div>
@endsection