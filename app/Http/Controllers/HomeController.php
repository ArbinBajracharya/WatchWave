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

        $videos = Video::withCount('comments')->take(6)->orderBy('id', 'desc')->get();

        $populars = Video::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(6)
            ->get();

        $actions = Video::whereJsonContains('genre', 'action')->withCount('comments')->take(6)->get();
        $adventures = Video::whereJsonContains('genre', 'adventure')->withCount('comments')->take(6)->get();
        $comedys = Video::whereJsonContains('genre', 'comedy')->withCount('comments')->take(6)->get();
        $fantesys = Video::whereJsonContains('genre', 'fantesy')->withCount('comments')->take(6)->get();
        $fictions = Video::whereJsonContains('genre', 'fiction')->withCount('comments')->take(6)->get();
        $horrors = Video::whereJsonContains('genre', 'horror')->withCount('comments')->take(6)->get();
        $romances = Video::whereJsonContains('genre', 'romance')->withCount('comments')->take(6)->get();



        $mostviews = Video::orderBy('view', 'desc')
            ->take(10)
            ->get();

        return view('index',compact('videos', 'sliders' ,'populars', 'mostviews','actions','adventures','comedys','fantesys','fictions','horrors','romances'));
    }
}
