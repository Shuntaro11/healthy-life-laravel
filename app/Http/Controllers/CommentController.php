<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Comment;
use \App\Post;

class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'comment' => ['required', 'string', 'max:200'],
        ]);
        
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        
        $comment->save();
        
        return back();
    }

    public function destroy ($id)
    {
        Comment::destroy($id);

        return back();
    }

}
