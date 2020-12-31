<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Bid extends Model
{
    use HasFactory;

    public function getUserName($id) {
    	$user = User::find($id);
    	return $user->name;
    }
}
