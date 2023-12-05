<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
      $posts = Post::withCount('comments')->get();
      $recent_posts = Post::orderBy()->take(5)->get();

      $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();

      $tags = Tag::latest()->take(50)->get();

      return view('home', [
        'posts' => $posts,
        'recent_posts' => $recent_posts,
        'categories' => $categories,
        'tags' => $tags
      ]);
    }
}
