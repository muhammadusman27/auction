<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    public function get_listing_title($id) {
        $watchlist = Watchlist::find($id);
        $listing = Listing::find($watchlist->listing_id);
        return $listing->title;
    }
    
}
