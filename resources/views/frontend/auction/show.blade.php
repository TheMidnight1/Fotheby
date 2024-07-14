@extends('frontend.layouts.master')

@section('title', 'Bid')

@section('content')
<style>
    .lot-image {
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .description {
        margin-top: 20px;
    }

    .alert {
        margin-top: 20px;
    }

    .bid-form {
        margin-top: 30px;
    }

    .btn-primary {
        font-size: 1rem;
    }

    .text-success {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .text-danger {
        font-size: 1.25rem;
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <h1 class="my-4">{{ $auction->item_name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('storage/' . $auction->image) }}" class="img-fluid lot-image" alt="Lot Image">
        </div>
        <div class="col-md-4">
            <h3 class="my-3">Description</h3>
            <p>{{ $auction->Description }}</p>
            <h3 class="my-3">Estimated Price: NPR {{ number_format($auction->EstimatedPrice) }}</h3>
            <h3 class="my-3">Lot Number: {{ $auction->LotNumber }}</h3>

            <!-- Display success message -->
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if ($isExpired)
                @if ($finalBid)
                    <h3 class="my-3 text-success">Sold for NPR {{ number_format($finalBid->amount) }} to {{ $finalBid->user->name }}</h3>
                @else
                    <h3 class="my-3 text-danger">Bidding Closed</h3>
                @endif
            @else
            <form action="/auctions/{{ $auction->id }}/bid" method="POST" class="bid-form">
                @csrf
                <div class="form-group">
                    <label for="bidAmount">Bid Amount (NPR)</label>
                    <input type="number" class="form-control" id="bidAmount" name="bid_amount" value="{{ old('bid_amount', $existingBid ? $existingBid->amount : '') }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Place Bid</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
