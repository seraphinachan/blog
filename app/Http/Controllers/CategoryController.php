<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class CategoryController extends Controller
{
    public function index()
    {
      // view all categories in the blog
    }

    public function show(Category $category)
    {
      $recent_posts = Post::orderBy()->take(5)->get();
      $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
      $tags = Tag::latest()->take(50)->get();

      return view('categories.show', [
        'category' => $category,
        'posts' => $category->posts()->paginate(5),
        'recent_posts' => $recent_posts,
        'categories' => $categories,
        'tags' => $tags
      ]);
    }
}
