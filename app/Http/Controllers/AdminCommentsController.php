<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

class AdminCommentsController extends Controller
{
    private $rules = [
        'post_id' => 'required|numeric',
        'the_comment' => 'required|min:3|max:1000'
    ];

    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin_dashboard.comments.edit', [
            'posts' => Post::pluck('title', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();

        Comment::create($validated);
        return redirect()->route('admin.comments.create')->with('success', '댓글이 등록되었습니다.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Comment $comment)
    {
        return view('admin_dashboard.categories.edit', [
            'posts' => Post::pluck('title', 'id'),
            'comment' => $comment
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate($this->rules);
        $comment->update($validated);
        return redirect()->route('admin.comments.update', $comment)->with('success', '댓글이 수정되었습니다.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', '댓글이 삭제되었습니다.');
    }
}
