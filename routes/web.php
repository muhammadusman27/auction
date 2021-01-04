<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CommentController;


Route::redirect('/' , '/home');

Route::post('/register', [UserController::class, 'registerUser'])->name('registerUser');
Route::get('/register', [UserController::class, 'registerPage'])->name('registerPage');

Route::get('/login', [UserController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser');



Route::middleware(['loginCheck'])->group( function () {

	# Categories route.
	Route::get('/home/categories',[HomeController::class, 'category'])->name('category');

	# Watchlist route.
	Route::get('/home/watchlist', [WatchlistController::class, 'watchlist'])->name('watchlist');;

	# Route to add/remove listing from Watchlist table.
	Route::post('/home/watch', [HomeController::class, 'watch'])->name('watch');
	Route::post('/home/watchRemove', [HomeController::class, 'watchDelete'])->name('deleteFromWatclist');

	Route::post('/home/create-Listing',[HomeController::class, 'storeListing'])->name('createNewListing');
	Route::get('/home/create-listing', [HomeController::class, 'createListing'])->name('formListing');

	# Rout to add bids
	Route::post('/home/placeBid',[BidController::class, 'addBid'])->name('placeBid');

	# Logout route
	Route::get('/logout', [UserController::class, 'logout'])->name('logout');

	Route::get('/home', [HomeController::class, 'home'])->name('home');

	Route::post('/home/comment/{id}', [CommentController::class, 'addComment'])->name('comment');

	# Specific category route
	Route::get('/home/category/{id}', [HomeController::class, 'specificCategory'])->name('uniqueCategory');
	# Close listing
	Route::patch('/home/{id}', [HomeController::class, 'closeListing'])->name('listingClose');

});


#listing route without middleware.
Route::get('/home', [HomeController::class, 'home'])->name('home');

# Open specific listing without login and with login.
Route::get('/home/{id}', [HomeController::class, 'item'])->name('specific');


# how to add middeleware on "/{id}" this route, so that the only access id's can be selected
