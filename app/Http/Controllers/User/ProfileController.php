<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        
        // Initialize defaults
        $watchlistCount = 0;
        $movies = collect();
        
        if ($user) {
            $watchlistIds = json_decode($user->watchlist ?? '[]', true) ?: [];
            $validIds = array_filter($watchlistIds, 'is_numeric');
            $watchlistCount = count($validIds);
            
            if ($validIds) {
                $movies = Video::whereIn('id', $validIds)
                            ->orderByRaw('FIELD(id, '.implode(',', $validIds).')')
                            ->get();
            }
        }
        
        return view('frontend.user_profile', compact('user', 'movies', 'watchlistCount'));
    }

    public function edit()
    {
        return view('user.profile.edit');
    }

    public function update(Request $request)
    {
        // Validate and update the user's profile
        // Redirect or return a response
    }
}
