<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostsController extends Controller
{
    public function show(Post $post) {

      $recent_posts = Post::orderBy()->take(5)->get();

      $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();

      $tags = Tag::latest()->take(50)->get();

      return view('post', [
        'post' => $post,
        'recent_posts' => $recent_posts,
        'categories' => $categories,
        'tags' => $tags
      ]);
    }
}
