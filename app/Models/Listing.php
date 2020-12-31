<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Listing extends Model
{
    use HasFactory;

    public function get_user_name($id) {
        $user_name = User::find($id);
        return $user_name->name;
    }

    public function get_category_name($id) {
        $name = Category::find($id);
        return $name->name;
    }

    public function check_watch($user_id, $listing_id) {
        $check = Watchlist::where('user_id', '=', $user_id)->where('listing_id', '=', $listing_id)->first();
        if ($check) {
            return true;
        }
        else {
            return false;
        }
    }


}
