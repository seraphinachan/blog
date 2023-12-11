<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    public function index()
    {
      return view('admin_dashboard.posts.index');
    }

    public function create()
    {
      return view('admin_dashboard.posts.create', [
        'categories' => Category::pluck('name', 'id')
      ]);
    }
    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
}