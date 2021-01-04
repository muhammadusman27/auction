@extends('layout')

@section('title')
    All Categories
@endsection

@section('content')

    <h2>All Categories</h2>
    <ul>
        @foreach ($categories as $category)
            <li><a href="{{ route('uniqueCategory', $category->id) }} " class="navigation_links">{{ $category->name }}</a></li>
        @endforeach
    </ul>

@endsection
