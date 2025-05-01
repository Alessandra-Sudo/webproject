<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function SignUpUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Please fill out your full name',
            'email.required' => 'Please fill out your email address',
            'email.unique' => 'Email has been already used',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            flash()->error($message);
            return redirect()->back()->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);
 
        sweetalert()->success('You successfully registered your account.');
        return redirect()->route('signin', [], 303);
    }

    public function SignInUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|exists:users',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Please insert your registered email',
            'email.exists' => 'Email does not exist',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            flash()->error($message);
            return redirect()->back()->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            flash()->error('Invalid credentials');
            return back()->withInput();
        }

        // if (Auth::user()->role == "admin"){

        // }

        Auth::login($user);
        sweetalert()->success('Welcome back, ' . $user->name . '!');
        return redirect()->route('home', [], 303);
    }

    public function SignOutUser(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        sweetalert()->success('You have successfully logged out.');
        return redirect()->route('home', [], 303);
    }
}
