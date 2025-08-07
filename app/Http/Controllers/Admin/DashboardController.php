<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Director;
use App\Models\Admin\Cast;
use App\Models\Admin\Video;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = Video::count();
        $casts = Cast::count();
        $directors = Director::count();
        $users = User::count();
        return view('admin.dashboard', compact('movies', 'casts', 'directors', 'users'));
    }
}
