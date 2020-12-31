@extends('layout')

@section('title')
    Watchlist
@endsection

@section('content')

    <h2>Watchlist</h2>
    <ul>
        @if ($items)
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('specific', $item->listing_id) }}">
                        {{ $item->get_listing_title($item->id) }}
                    </a>
                </li>
            @endforeach
        @else
            <li>Watchlist is empty.</li>
        @endif
    </ul>

@endsection
