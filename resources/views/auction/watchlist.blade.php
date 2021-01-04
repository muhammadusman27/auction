@extends('layout')

@section('title')
    Watchlist
@endsection

@section('content')

    <h2>Watchlist</h2>
    <ul>
        @if ($items)
            @forelse ($items as $item)
                <li>
                    <a href="{{ route('specific', $item->listing_id) }}" class="navigation_links">
                        {{ $item->get_listing_title($item->id) }}
                    </a>
                </li>
            @empty
                <li>Watchlist is empty.</li>
            @endforelse
        @endif
    </ul>

@endsection
