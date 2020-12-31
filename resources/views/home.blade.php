@extends('layout')

@section('title')
    Home Page
@endsection

@section('content')
    <h2>Active Listings</h2>
    <div class="container">
        @foreach ($listings as $listing)
            <div class="row">
                <div class="col-6" class="height_of_row">
                    <img src="{{ $listing->image_url }}" class="width_of_image" >
                </div>
                <div class="col-6" class="height_of_row">
                    <h4><a href="{{ route('specific', $listing->id) }}">{{ $listing->title }}</a></h4>
                    <p><strong>Price: </strong>${{$listing->starting_bid}}.00</p>
                    <p>{{ $listing->description }}</p>
                    <p>{{ $listing->created_at->format('M d. Y, h:i a')}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
