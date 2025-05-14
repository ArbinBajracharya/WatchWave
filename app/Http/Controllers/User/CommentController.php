<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Comments;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $user = User::find(auth()->id());
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to manage your watchlist');
        }


        $comment['video_id'] = $request->input('video_id');
        $comment['user_id'] = Auth::id();
        $comment['comment'] = $request->input('comment');

        Comments::create($comment);
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
