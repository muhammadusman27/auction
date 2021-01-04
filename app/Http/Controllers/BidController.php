<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid;

class BidController extends Controller
{
    public function addBid(Request $request) {
        #dd((int)$request['value']);
        #dd((int)$request['listing_id']);
        $check_bid = Bid::where('listing_id', (int)$request['listing_id'])->orderBy('created_at', 'desc')->first();
        if ($check_bid) {
            if((int)$request['value'] > $check_bid->value) {
                $list = Listing::find((int)$request['listing_id']);
                $creat_bid = new Bid();
                $creat_bid->listing_id = $list->id;
                $creat_bid->user_id = session('id');
                $creat_bid->value = (int)$request['value'];
                $creat_bid->save();
                return redirect()->back()->with('message','Congrats! You bid has been placed.');
            } else {
                return redirect()->back()->with('message','Oops ! Your bid price is smaller than already placed bid value.');
            }
        } else {
            $list = Listing::find((int)$request['listing_id']);
            if ((int)$request['value'] >= $list->starting_bid ) {
                $creat_bid = new Bid();
                $creat_bid->listing_id = $list->id;
                $creat_bid->value = (int)$request['value'];
                $creat_bid->user_id = session('id');
                $creat_bid->save();
                return redirect()->back()->with('message','Congrats! You bid has been placed.');
            } else {
                return redirect()->back()->with('message','Oops ! Your bid price is smaller than bid value.');
                
            }
        }
    }
}
