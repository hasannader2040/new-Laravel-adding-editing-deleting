<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
$incomingFields = $request->validate(
    [
        "email"=> "required",
        "name"=> "required",
        "password"=> "required",
    ]
);

        return 'Hello from our controller';
    }
    
}
