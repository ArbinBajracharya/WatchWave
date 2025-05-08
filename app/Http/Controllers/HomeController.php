<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Video;
use App\Models\User\Comments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Video::where('homepage', 'active')->get();

        $videos = Video::withCount('comments')->get();

        $populars = Video::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();

        $actions = Video::whereJsonContains('genre', 'action')->take(6)->get();
        $adventures = Video::whereJsonContains('genre', 'adventure')->take(6)->get();
        $comedys = Video::whereJsonContains('genre', 'comedy')->take(6)->get();
        $fantasys = Video::whereJsonContains('genre', 'fantasy')->take(6)->get();
        $fictions = Video::whereJsonContains('genre', 'fiction')->take(6)->get();
        $horrors = Video::whereJsonContains('genre', 'horror')->take(6)->get();
        $romances = Video::whereJsonContains('genre', 'romance')->take(6)->get();
        


        $mostviews = Video::orderBy('view', 'desc')
            ->take(5)
            ->get();

        return view('index',compact('videos', 'sliders' ,'populars', 'mostviews','actions','adventures','comedys','fantasys','fictions','horrors','romances'));
    }
}
