<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Watchlist;
use App\Models\Bid;
use App\Models\Comment;

class HomeController extends Controller
{

    public function home() {
        return view('home', ['listings' => Listing::orderBy('created_at', 'desc')->where('is_active', True)->get()]);
    }

    // Form for create Listing.
    public function createListing() {
        return view('auction.create',['categories'=> Category::all()]);
    }
    // Store the new listing when the form is submitte.
    public function storeListing(Request $request) {
        $listing = new Listing();
        $listing->title = $request['title'];
        $listing->description = $request['description'];
        $listing->starting_bid = $request['starting_bid'];
        $listing->category_id = $request['category_id'];
        $listing->user_id = session('id');
        if ($request['image_url'] == '') {
            $listing->image_url = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRA27jEjbI3sys4xgVspSAb3AVoVqnLlPleKw&usqp=CAU";
        }
        else {
            $listing->image_url = $request['image_url'];
        }
        $listing->save();
        return redirect()->route('home');
    }


    public function category() {
        return view('auction.categories',['categories'=>Category::all()]);
    }

    public function item($id) {
        $bid_count = Bid::where('listing_id', $id)->count();
        if ($bid_count != 0) {
            $bid_value = Bid::where('listing_id', $id)->orderBy('created_at', 'desc')->first();
            $comments = Comment::where('listing_id', $id)->orderBy('created_at', 'desc')->get();
            #dd($bid_value->user_id);
            #dd($bid_value->getUserName($bid_value->user_id));
            $listing = Listing::find($id);
            if ($listing->is_active == false) {
                #dd('listing is closed');
                if (session('id') == $bid_value->user_id)
                {
                    #dd('congrats, you won the bid');
                    return view('auction.specific', [
                        'item' => $listing,
                        'count' => $bid_count,
                        'bid_value' => $bid_value->value,
                        'bidPostedByUserName' => $bid_value->getUserName($bid_value->user_id),
                        'comments' => $comments,
                        'won' => true
                    ]);
                }
            }
            return view('auction.specific', [
                'item' => $listing,
                'count' => $bid_count,
                'bid_value' => $bid_value->value,
                'bidPostedByUserName' => $bid_value->getUserName($bid_value->user_id),
                'comments' => $comments,
                'won' => false
            ]);
        }
        else {
            $listing = Listing::find($id);
            $comments = Comment::where('listing_id', $id);
            return view('auction.specific', [
                'item' => $listing,
                'count' => 0,
                'bid_value' => $listing->starting_bid,
                'bidPostedByUserName' => $listing->get_user_name($listing->user_id),
                'comments' => $comments,
                'won' => false
            ]);
        }
    }

    public function closeListing ($id) {
        $listing = Listing::find($id);
        $listing->is_active = false;
        $listing->save();
        return redirect()->route('home');
    }

    public function watch(Request $request) {
        $watch = new Watchlist();
        $watch->user_id = $request['user_id'];
        $watch->listing_id = $request['listing_id'];
        $watch->save();
        return redirect()->route('specific', $watch->listing_id);
    }

    public function watchDelete(Request $request) {
        $x = $request['listing_id'];
        $watchlist_listing = Watchlist::where('user_id', '=', session('id'))->where('listing_id', '=', (int)$request['listing_id'])->first();
        $watchlist_listing->delete();
        return redirect()->route('specific', (int)$request['listing_id']);
    }

    public function specificCategory($id) {
        return view('auction.categoryspecific', [
            'items' => Listing::where('category_id', $id)->get(),
            'name' => Category::where('id', $id)->pluck('name')->first()
        ]);
    }

}
