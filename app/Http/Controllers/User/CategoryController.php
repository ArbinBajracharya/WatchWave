<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $videos = Video::paginate(15);

        $mostviews = Video::orderBy('view', 'desc')
            ->take(5)
            ->get();

        return view('frontend.categories', compact('videos', 'mostviews'));
    }

    public function sortby($type){
        $videos = Video::whereJsonContains('genre', $type)->withCount('comments')->orderBy('created_at', 'desc')->paginate(15);

        $mostviews = Video::orderBy('view', 'desc')
            ->take(5)
            ->get();

        return view('frontend.categories', compact('videos','mostviews', 'type'));
    }

    public function search(Request $request)
    {
        $search = strtolower($request->input('search'));
        $allVideos = Video::all(); // You can paginate if it's too big

        $videos = [];

        foreach ($allVideos as $video) {
            $title = strtolower($video->title);
            if (stripos($title, $search) !== false) {
                $videos[] = $video;
            }
        }

        $mostviews = Video::orderBy('view', 'desc')
            ->take(5)
            ->get();

        return view('frontend.categories', compact('videos', 'mostviews'));
    }

}
