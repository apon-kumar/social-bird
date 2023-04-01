<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    public function postCreatePost(Request $request)
    {
        // dd($request->body);
        auth()->user()->posts()->create($request->all());
        return redirect('home');
    }

    public function createComment(Request $request, $id)
    {
        $data = [
            'post_id' => $id,
            'user_id' => auth()->user()->id,
            'body'    => $request->comment_body,
        ];

        Comment::create($data);
        return redirect()->back();
    }

    public function viewPost(Post $post)
    {
        $commentobj = new Comment();
        $comments = $commentobj->join('users', 'users.id', '=', 'comments.user_id')
             ->select('comments.*', 'users.name as user_name')
             ->where('comments.post_id', $post->id)
             ->get();
        return view('post', compact('comments', 'post'));
    }
}
