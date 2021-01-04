@extends('layout')

@section('title')
    {{ $item->title }}
@endsection

@section('content')
    @if ($won)
        <p class="alert alert-success">Congrats! You won the item because your bid was the highest one.</p>
    @endif
    <div class="row">
        <div class="col-lg-6"> 
            @if (session()->has('message'))
                <p class="alert alert-info">{{ session()->get('message') }}</p>
            @endif
            <h2 class="">{{ $item->title }}</h2>
            <img src="{{ $item->image_url }}" alt="Invalid Link" class="width_of_image">
            <br>
            @if (session('id'))
                @if ($item->check_watch(session('id'), $item->id))
                <form  action="{{ route('deleteFromWatclist') }}" method="post">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $item->id }}">
                    <input type="submit" value="Remove from Watchlist" class="mt-1 btn btn-secondary btn-sm">
                </form>
                @else
                    <form  action="{{ route('watch') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="listing_id" value="{{ $item->id }}">
                        <input type="submit" value="Add to Watchlist" class="mt-1 btn btn-primary btn-sm">
                    </form>
                @endif
            @endif
        </div>
        <div class="col-lg-6">
            <h4 class="mt-3">Description:</h4>
            <p class="m-0">{{ $item->description }}</p>
            <h4 class="mt-3 mb-3">${{ $bid_value }}.00</h4>

            {{-- check if the user is login --}}
            @if (session('id'))

                {{-- Message that shows how many bids have been place on this item and whose user bid is the current bid --}}
                
                {{-- if bid is won by the current login user it will hide this message --}}
                @if(!$won)
                    @if ($count != 0)
                        <p class="m-0"> {{ $count }} bids so far. This bid is posted by <b>{{ $bidPostedByUserName }} </b></p>
                    @else
                        <p class="m-0"> Be the first to place your bid.</b></p>
                    @endif
                @endif

                {{-- if the login user is the one who created the listing he will be able to close the listing, he can't see the bid form because this is the same login user who created this listing --}}
                @if (session('id') == $item->user_id )
                    {{-- rendering close listing button. --}}
                    <form action="{{ route('listingClose', $item->id) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <input type="submit" value="Close this Listing" class="mt-2 btn btn-primary btn-sm">
                    </form>
                @else
                    {{-- rendering place bid form --}}
                    @if (!$won)
                        <form action="{{ route('placeBid') }}" method="post">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $item->id }}">
                            <div class="form-group">
                                <input type="number" min="0" name="value" placeholder="Bid" class="form-control" required>
                            </div>
                            <input type="submit" value="Place Bid" class="mt-3 btn btn-primary btn-sm">
                        </form>
                    @endif
                @endif
            @endif
            <h4 class="mt-2">Details</h4>
            <ul>
                <li>Listed by: <b>{{ $item->get_user_name($item->user_id) }}</b></li>
                <li>Category: {{ $item->get_category_name($item->user_id) }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        @if (session('id'))
            <div class="col-lg-6">
                <h4 class="mt-1">All Comments</h4>
                <ul>
                    @forelse ($comments as $comment)
                        <li><b>{{ $comment->getUserName($comment->user_id) }}</b> {{ $comment->comment }}</li>
                    @empty
                        <li>Be the first to add comment.</li>
                    @endforelse
                </ul>
            </div>
            <div class="col-lg-6">
                <h4 class="mt-1">Add Comment</h4>
                <form method="post" action="{{ route('comment', $item->id) }}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Comment" name="comment" required></textarea>
                    </div>
                    <input type="submit" value="Add Comment" class="btn btn-primary btn-sm mt-1">
                </form>
            </div>
        @endif
    </div>
@endsection
