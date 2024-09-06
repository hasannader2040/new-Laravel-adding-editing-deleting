<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function actuallyUpdatePost(Post $post, Request $request) {
        
    }

    public function showEditScreen(Post $post)
    {
        return view('edit-post', [Post => $post]);
    }

    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // Sanitize input fields
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id(); // Assign the current authenticated user

        // Create the post
        Post::create($incomingFields);

        // Redirect to the home page
        return redirect('/');
    }
}
