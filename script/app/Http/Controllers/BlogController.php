<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $limit = Settings::selectSettings('max_posts');
        $posts = Post::where("status", "=", 1)->orderBy('created_at', 'DESC')->paginate($limit);
        return view('frontend.blog', compact('posts'));
    }
}
