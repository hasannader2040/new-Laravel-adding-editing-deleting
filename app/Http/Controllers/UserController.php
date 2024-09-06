<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required', // This will contain the email
            'loginpassword' => 'required'
        ]);

        // Attempt to authenticate using email and password
        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            // Regenerate session after successful login
            $request->session()->regenerate();
            return redirect('/'); // Redirect or return a response after login
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        // Log the user out
        auth()->logout();

        // Redirect to the homepage or another location after logout
        return redirect('/');
    }



    public function register(Request $request)
    {
        $incomingFields = $request->validate(
            [

                'name' => ['required', Rule::unique('users', 'name')],

                'email' => ['required', 'email', Rule::unique('users', 'email')],
                // |min:3|max:10
                'password' => 'required|min:8|max:200'
                // |min:8|max:200
            ]
        );


        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');

        //return 'Hello from our controller';
    }
}
