<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function watchlist() {
        #dd(session('id'));
        #dd(Watchlist::find(session('id')));
        return view('auction.watchlist', ['items' => Watchlist::all()->where('user_id', '=', (int)session('id'))]);
    }
}
