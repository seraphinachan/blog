<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
      // view all tags in the blog
    }

    public function show(Tag $tag)
    {
      return view('tags.show', [
        'tag' => $tag
      ]);
    }
}
