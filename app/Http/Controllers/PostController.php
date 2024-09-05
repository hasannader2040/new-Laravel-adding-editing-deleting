<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'requied',
            'body' => 'requied'
        ]);
        $incomingFields['titile'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        Post::create($incomingFields);
        return redirect('/');
    }
}
