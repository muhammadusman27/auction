<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> @yield('title') </title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Auctions</h1>
            <p>
                @if(!session('id'))
                    Not signed in
                @else
                    Signed in as <b> {{ session('user_name') }}</b>
                @endif
            </p>
            <div>
                <a href="{{ route('home') }}" class="me-3 navigation_links">Active Listings</a>
                @if(!session('id'))
                    <a href="{{ route('loginPage')}}" class="me-3 navigation_links">Log In</a>
                    <a href="{{ route('registerPage') }}" class="me-3 navigation_links">Register</a>
                @else
                    <a href="{{ route('category') }}" class="me-3 navigation_links">Categories</a>
                    <a href="{{ route('watchlist') }}" class="me-3 navigation_links">Watchlist</a>
                    <a href="{{ route('formListing') }}" class="me-3 navigation_links">Create Listing</a>
                    <a href="{{ route('logout') }}" class="me-3 navigation_links" >Logout</a>
                @endif
            </div>
            <hr>

            @yield('content')
        </div>
    </body>
</html>
