@extends('layout')

@section('title')
    Login
@endsection

@section('content')
    <h2>Login</h2>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session()->get('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <form method="post" action="{{ route('loginUser') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
        </div>
        <br>
        <div class="form-group">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
        </div>
        <br>
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
@endsection
