<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate(
            [
                'email' => 'required|min:3|max:10',
                'name' => 'required',
                'password' => 'required|min:8|max:200'
            ]
        );
        
        return 'Hello from our controller';
    }
}
