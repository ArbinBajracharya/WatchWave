<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\User;
use App\Models\User\Comments;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function details($id)
    {
        $details = Video::where('id', $id)->first();
        $comments = Comments::where('video_id', $id)->get();
        return view('frontend.details', compact('details', 'comments'));
    }

    public function video($id)
    {
        $video = Video::where('id', $id)->first();
        return view('frontend.watch', compact('video'));
    }

    public function watchlist($id)
    {
        $user = User::find(auth()->id());
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to manage your watchlist');
        }

        // Get current watchlist or initialize empty array
        $watchlist = json_decode($user->watchlist ?? '[]', true) ?: [];
        
        // Check if video exists
        if (!Video::where('id', $id)->exists()) {
            return back()->with('error', 'Video not found');
        }

        // Toggle the ID in watchlist
        if (($key = array_search($id, $watchlist)) !== false) {
            // Remove if exists
            unset($watchlist[$key]);
        } else {
            // Add if doesn't exist
            $watchlist[] = $id;
        }

        // Update and save
        $user->watchlist = json_encode(array_values($watchlist)); // Reindex array
        $user->save();

        return back()->with('success', 'Watchlist updated successfully');
    }

    public function increaseView($id)
    {
        $video = Video::findOrFail($id);
        $video->increment('view');

        return response()->json(['message' => 'View count updated']);
    }
}
