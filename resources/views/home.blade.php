@extends('layout')

@section('title')
    Home Page
@endsection

@section('content')
    <h2>Active Listings</h2>
    <br>
    <div class="container">
        @foreach ($listings as $listing)
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <img src="{{ $listing->image_url }}" class="home_image">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4 class="mt-2"><a href="{{ route('specific', $listing->id) }}" class="navigation_links">{{ $listing->title }}</a></h4>
                    <p><strong>Price: </strong>${{$listing->starting_bid}}.00</p>
                    <p>{{ $listing->description }}</p>
                    <p>{{ $listing->created_at->format('M d. Y, h:i a')}}</p>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
