
@extends('frontend.layouts.master')

@section('title', 'Home Page')

@section('content')<div class="container">
    <h1 class="my-4">{{ $auction->item_name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('storage/' . $auction->image) }}" class="img-fluid" alt="...">
        </div>
        <div class="col-md-4">
            <h3 class="my-3">Description</h3>
            <p>{{ $auction->Description }}</p>
            <h3 class="my-3">Estimated Price NPR {{ number_format($auction->EstimatedPrice) }}</h3>
            <h3 class="my-3">Lot number: {{ $auction->LotNumber }}</h3>
            <form action="/auctions/{{ $auction->id }}/bid" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bidAmount">Bid Amount (NPR)</label>
                    <input type="number" class="form-control" id="bidAmount" name="bid_amount" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Place Bid</button>
            </form>
        </div>
    </div>
</div>
@endsection
