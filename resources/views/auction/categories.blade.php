@extends('layout')

@section('title')
    Home Page
@endsection

@section('content')

    <h2>All Categories</h2>
    <ul>
        @foreach ($categories as $category)
            @if ($category->id !=1 )
                <li>{{ $category->name }}</li>
            @endif
        @endforeach
    </ul>

@endsection
