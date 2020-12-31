@extends('layout')

@section('title')
    Register
@endsection

@section('content')

    <h2>Register</h2>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
        </div>
        <br>
        <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
        </div>
        <br>
        <div class="form-group">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
        </div>
        <br>
        <input type="submit" value="Register" class="btn btn-primary">
    </form>
@endsection
