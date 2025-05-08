<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Director;
use App\Models\Admin\Video;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function show($name)
    {
        // URL decode the name first
        $actorName = urldecode($name);
        $casts = Director::where('name', $actorName)->first();
        // Fetch all movies featuring this actor
        $movies = Video::whereJsonContains('director', $actorName)->get();
        
        // If no movies found, you might want to redirect
        if ($movies->isEmpty()) {
            return redirect()->back()->with('error', 'Actor not found');
        }
        
        return view('frontend.cast_details',compact('movies','casts'));
    }
}
