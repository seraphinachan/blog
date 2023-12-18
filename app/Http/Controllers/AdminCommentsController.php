<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

class AdminCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.comments.edit', [
            'posts' => Post::pluck('title', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'post_id' => 'required|numeric',
            'the_comment' => 'required|min:3|max:1000'
        ];
        $validated = $request->validate($rules);
        $validated['user_id'] = auth()->id();

        Comment::create($validated);
        return redirect()->route('admin.comments.create')->with('success', '댓글이 등록되었습니다.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $rules = [
            'post_id' => 'required|numeric',
            'the_comment' => 'required|min:3|max:1000'
        ];
        $validated = $request->validate($rules);
        $validated['user_id'] = auth()->id();

        $comment->update($validated);
        return redirect()->route('admin.comments.create')->with('success', '댓글이 등록되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
