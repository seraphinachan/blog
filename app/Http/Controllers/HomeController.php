<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
      $posts = Post::withCount('comments')->get();
      $recent_posts = Post::orderBy()->take(5)->get();

      return view('home', [
        'posts' => $posts,
        'recent_posts' => $recent_posts,
      ]);
    }
}
