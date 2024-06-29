@extends('frontend.layouts.master')
@section('title', 'Add bid')

@section('content')
<div class="container">
    <h1>Add New Auction Item</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('auction.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="LotNumber">Lot Number</label>
            <input type="text" name="LotNumber" id="LotNumber" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" name="Title" id="Title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" id="Description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="ArtistName">Artist Name</label>
            <input type="text" name="ArtistName" id="ArtistName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="BuiltYear">Built Year</label>
            <input type="number" name="BuiltYear" id="BuiltYear" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="AuctionDate">Auction Date</label>
            <input type="date" name="AuctionDate" id="AuctionDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="EstimatedPrice">Estimated Price</label>
            <input type="number" name="EstimatedPrice" id="EstimatedPrice" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="AuctionCategory">Auction Category</label>
            <select name="AuctionCategory" id="AuctionCategory" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" step="0.01" name="height" id="height" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="width">Width</label>
            <input type="number" step="0.01" name="width" id="width" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="weight" id="weight" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="Frame">Frame</label>
            <select name="Frame" id="Frame" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Auction Item</button>
    </form>
</div>
@endsection