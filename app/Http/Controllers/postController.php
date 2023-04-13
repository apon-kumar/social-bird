<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use exception;

use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    public function postCreatePost(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('post-image', $filename, 'public');
        
            $data = [
                'body'    => $request->body,
                'photo'   => $filename,
                'user_id' => auth()->user()->id,
            ];
            Post::create($data);
            return redirect('home');
        }
        $data = [
            'body'    => $request->body,
            'user_id' => auth()->user()->id,
        ];
        Post::create($data);
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

    public function deleteComment($id)
    {
        Comment::where('id', $id)->delete();
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

    public function likePost($id)
    {
        $likes = Like::where('post_id', $id)
                       ->where('user_id', auth()->user()->id)
                       ->get();
        // dd($id, auth()->user()->id);
        $like_id = 'false';
        foreach($likes as $like){
            $like_id = $like->id;
        }

        if($like_id != 'false'){
            $like->delete();          
        }
        else{
            $data = [
                'post_id' => $id,
                'user_id' =>auth()->user()->id,
            ];
            Like::create($data);
        }

        return redirect('home');
    }

    public function deletePost($id)
    {
        Post::where('id', $id)->delete();
        return redirect('home');
    }

    public function editPost(Post $post)
    {       
        return view('postEdit', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        // dd($request->all());
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('post-image', $filename, 'public');

            $post->update([
                'body' => $request->body,
                'photo' =>$filename
            ]);
        }    
        else{
            $post->update(['body' => $request->body]);
        }
        
        return redirect('/home/'.$post->id.'/viewpost');
    }

    public function updateComment(Request $request, $id)
    {
        $query = Comment::where('id', $id)->update(['body' => $request->body]);
        if($query){ 
            return redirect('home');
        }
        else{ 
            return redirect()->back()->withErrors(['error' => 'Comment could not be updated!']);
        }
    }
}
