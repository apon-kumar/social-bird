<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
class homeController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        return view('home', compact('posts'));
    }
}
