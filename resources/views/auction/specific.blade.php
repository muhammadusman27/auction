@extends('layout')

@section('title')
    Categories
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6"> 
            @if (session()->has('message'))
                <p class="alert alert-info">{{ session()->get('message') }}</p>
            @endif
            <h2>{{ $item->title }}</h2>
            @if (session('id'))
                @if ($item->check_watch(session('id'), $item->id))
                <form  action="{{ route('delete_from_watclist') }}" method="post">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $item->id }}">
                    <input type="submit" value="Remove from Watchlist" class="btn btn-secondary">
                </form>
                @else
                    <form  action="{{ route('watch') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="listing_id" value="{{ $item->id }}">
                        <input type="submit" value="Add to Watchlist" class="btn btn-primary">
                    </form>
                @endif
            @endif
            <br>
            <img src="{{ $item->image_url }}" alt="Invalid Link" height="300">
            <br>
            <p>{{ $item->description }}</p>
            <h4>${{ $bid_value }}.00</h4>

            {{-- check if the user is login --}}
            @if (session('id'))

                {{-- Message that shows how many bids have been place on this item and whose user bid is the current bid --}}
                    @if ($count != 0)
                        <p class="m-0"> {{ $count }} bids so far. This bid is posted by <b>{{ $bidPostedByUserName }} </b></p>
                    @else
                        <p class="m-0"> Be the first to place your bid.</b></p>
                    @endif

                {{-- if the login user is the one who created the listing he will be able to close the listing, he can't see the bid form because this is the same login user who created this listing --}}
                @if (session('id') == $item->user_id )
                    {{-- rendering close listing button. --}}
                    <form action="{{ route('listing_close', $item->id) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <input type="submit" value="Close this Listing" class="btn btn-primary">
                    </form>
                @else
                    {{-- rendering place bid form --}}
                    <form action="{{ route('place_bid') }}" method="post">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $item->id }}">
                        <div class="form-group">
                            <input type="number" min="0" name="value" placeholder="Bid" class="form-control" required>
                        </div>
                        <input type="submit" value="Place Bid" class="mt-3 btn btn-primary">
                    </form>
                    <br>
                @endif
            @endif
            <h4>Details</h4>
            <ul>
                <li>Listed by: {{ $item->get_user_name($item->user_id) }}</li>
                <li>Category: {{ $item->get_category_name($item->user_id) }}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            @if (session('id'))
                <div>
                    <h4>Comments</h4>
                    <ul>
                        @foreach ($comments as $comment)
                            <li><b>{{ $comment->getUserName($comment->user_id) }}</b> {{ $comment->comment }}</li>
                        @endforeach
                    </ul>
                    <form method="post" action="{{ route('comment', $item->id) }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Comment" name="comment" required></textarea>
                        </div>
                        <input type="submit" value="Add Comment" class="btn btn-primary mt-1">
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
