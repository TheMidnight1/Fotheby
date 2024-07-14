@extends('frontend.layouts.master')

@section('title', 'Home Page')

@section('content')
<style>
    .lot-card {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: transform 0.3s;
    }

    .lot-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .lot-card img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 5px;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 3px;
        color: white;
    }

    .sold-badge {
        background-color: red;
    }

    .new-badge {
        background-color: green;
    }

    .expired-badge {
        background-color: gray;
    }

    .lot-card h5 {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 10px;
    }

    .lot-card h6 {
        font-size: 1rem;
        font-weight: normal;
    }

    .lot-card p {
        font-size: 0.9rem;
    }

    .btn-primary, .btn-success, .btn-warning, .btn-danger {
        font-size: 0.9rem;
    }

    .header-info {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 mb-3 header-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>My Items</h6>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3 btn-container">
            <a href="{{ route('auction.create') }}" class="btn btn-primary mx-1">Add Auction Items</a>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between">
                <span>Category: All Categories</span>
                <span>Lots in auction: {{ $auctions->count() }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($auctions as $auction)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="lot-card">
                    <img src="{{ asset('storage/' . $auction->image) }}" alt="Lot {{ $auction->LotNumber }}">
                    <h5>{{ $auction->Title }}</h5>

                    @php
                        $createdAt = $auction->created_at;
                        $createdAtDateTime = \Carbon\Carbon::parse($createdAt);
                    @endphp

                    @if ($createdAtDateTime->addMinutes(15)->isPast())
                        <span class="badge expired-badge">EXPIRED</span>
                    @else
                        <span class="badge new-badge">NEW</span>
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
                    </form>
                    <a href="{{ route('auction.edit', $auction->id) }}" class="btn btn-warning">EDIT THIS LOT</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
