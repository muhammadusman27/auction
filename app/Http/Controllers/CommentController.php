<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request, $id) {
    	$comment = new Comment();
    	$comment->comment = $request['comment'];
    	$comment->listing_id = $id;
    	$comment->user_id = session('id');
    	#dd($comment->user_id);
    	$comment->save();
    	return redirect()->route('specific', $id);
    }
}
