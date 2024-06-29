@extends('frontend.layouts.master')
@section('title', 'Edit Auction Item')

@section('content')
<div class="container">
    <h1>Edit Auction Item</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('auction.update', $auction->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="LotNumber">Lot Number</label>
            <input type="text" name="LotNumber" id="LotNumber" class="form-control" value="{{ $auction->LotNumber }}" required>
        </div>

        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" name="Title" id="Title" class="form-control" value="{{ $auction->Title }}" required>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" id="Description" class="form-control" required>{{ $auction->Description }}</textarea>
        </div>

        <div class="form-group">
            <label for="ArtistName">Artist Name</label>
            <input type="text" name="ArtistName" id="ArtistName" class="form-control" value="{{ $auction->ArtistName }}" required>
        </div>

        <div class="form-group">
            <label for="BuiltYear">Built Year</label>
            <input type="number" name="BuiltYear" id="BuiltYear" class="form-control" value="{{ $auction->BuiltYear }}" required>
        </div>

        <div class="form-group">
            <label for="AuctionDate">Auction Date</label>
            <input type="date" name="AuctionDate" id="AuctionDate" class="form-control" value="{{ $auction->AuctionDate }}" required>
        </div>

        <div class="form-group">
            <label for="EstimatedPrice">Estimated Price</label>
            <input type="number" name="EstimatedPrice" id="EstimatedPrice" class="form-control" value="{{ $auction->EstimatedPrice }}" required>
        </div>

        <div class="form-group">
            <label for="AuctionCategory">Auction Category</label>
            <select name="AuctionCategory" id="AuctionCategory" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($auction->AuctionCategory == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($auction->image)
            <img src="{{ asset('storage/' . $auction->image) }}" alt="Current Image" class="mt-2" width="150">
            @endif
        </div>

        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" step="0.01" name="height" id="height" class="form-control" value="{{ $auction->height }}" required>
        </div>

        <div class="form-group">
            <label for="width">Width</label>
            <input type="number" step="0.01" name="width" id="width" class="form-control" value="{{ $auction->width }}" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="weight" id="weight" class="form-control" value="{{ $auction->weight }}" required>
        </div>

        <div class="form-group">
            <label for="Frame">Frame</label>
            <select name="Frame" id="Frame" class="form-control" required>
                <option value="1" @if($auction->Frame == 1) selected @endif>Yes</option>
                <option value="0" @if($auction->Frame == 0) selected @endif>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Auction Item</button>
    </form>
</div>
@endsection
