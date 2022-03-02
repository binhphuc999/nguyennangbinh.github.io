<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Page;
use App\Models\Statistic;

class DashboardController extends Controller
{

    public function index()
    {
        $total_email = Statistic::where("key", "total_email_pay_day")
            ->orderBy('created_at', 'DESC')->limit(7)->get();

            
        $total_email = $total_email->reverse();

        $total_messges = Statistic::where("key", "total_messges_pay_day")
            ->orderBy('created_at', 'DESC')->limit(7)->get();

        $total_messges = $total_messges->reverse();

        $posts = Post::all()->count();
        $pages = Page::all()->count();

        return view('backend.dashboard', compact('posts', 'pages', 'total_email', 'total_messges'));
    }



    public function settings()
    {
        return view('backend.settings.index');
    }
}
