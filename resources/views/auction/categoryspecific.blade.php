@extends('layout')

@section('title')
    {{ $name }}
@endsection

@section('content')

    <h2>{{ $name }}</h2>
    @forelse ($items as $item)
	    <li><a href="{{ route('specific', $item->id) }}" class="navigation_links">{{ $item->title }}</a></li>
	@empty
	    <p>No Listing in this category.</p>
	@endforelse

@endsection
