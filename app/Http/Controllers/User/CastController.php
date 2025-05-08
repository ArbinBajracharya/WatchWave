<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cast;
use App\Models\Admin\Video;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function show($name)
    {
        // URL decode the name first
        $actorName = urldecode($name);
        $casts = Cast::where('name', $actorName)->first();
        // Fetch all movies featuring this actor
        $movies = Video::whereJsonContains('cast', $actorName)->get();
        
        // If no movies found, you might want to redirect
        if ($movies->isEmpty()) {
            return redirect()->back()->with('error', 'Actor not found');
        }
        
        return view('frontend.cast_details',compact('movies','casts'));
    }
}
