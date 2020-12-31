<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CommentController;


Route::redirect('/' , '/home');

Route::match(['get', 'post'],'/register', [UserController::class, 'register'])->name('register');
Route::match(['get', 'post'] ,'/login', [UserController::class, 'login'])->name('login_user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

# Categories route.
Route::get('/home/categories',[HomeController::class, 'category'])->name('category')->middleware('login_check');

# Watchlist route.
Route::get('/home/watchlist', [WatchlistController::class, 'watchlist'])->name('watchlist')->middleware('login_check');;

# Route to add/remove listing from Watchlist table.
Route::post('/home/watch', [HomeController::class, 'watch'])->name('watch')->middleware('login_check');
Route::post('/home/watch_remove', [HomeController::class, 'watch_delete'])->name('delete_from_watclist')->middleware('login_check');

#listing route without middleware.
Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::post('/home/create-Listing',[HomeController::class, 'storeListing'])->name('createNewListing')->middleware('login_check');
Route::get('/home/create-listing', [HomeController::class, 'createListing'])->name('formListing')->middleware('login_check');

# Rout to add bids
Route::post('/home/place_bid',[BidController::class, 'add_bid'])->name('place_bid')->middleware('login_check');

Route::post('/home/comment/{id}', [CommentController::class, 'addComment'])->name('comment')->middleware('login_check');


# Open specific listing without login and with login.
Route::get('/home/{id}', [HomeController::class, 'item'])->name('specific');

# Close listing
Route::patch('/home/{id}', [HomeController::class, 'close_listing'])->name('listing_close')->middleware('login_check');
# how to add middeleware on "/{id}" this route, so that the only access id's can be selected

#Route::get('/welcome', [HomeController::class, 'welcome'])->middleware('login_check');5