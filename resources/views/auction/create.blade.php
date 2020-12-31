@extends('layout')

@section('title')
    Create
@endsection

@section('content')

    <h2>Create Listing</h2>
    <form action="{{ route('createNewListing') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <br>
        <select class="form-select" name='category_id'>
            @foreach ($categories as $category)
                @if ($category->id != 1)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}" selected> {{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        <br>
        <div class="form-group">
            <input type="number" min="1" name="starting_bid" class="form-control" placeholder="Starting Bid" required>
        </div>
        <br>
        <div class="form-group">
            <textarea name="description" rows="4" class="form-control" placeholder="Short descriptin" required></textarea>
        </div>
        <br>
        <div class="form-group">
            <input type="url" name="image_url" placeholder="Enter Image URL" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <input type="submit" value="Create Listing" class="form-control btn btn-primary">
        </div>
    </form>

@endsection
