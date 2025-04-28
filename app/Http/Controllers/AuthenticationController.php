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
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            flash()->error($message);
            return redirect()->back()->withInput()->setStatusCode(422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer',
        ]);

        sweetalert()->success('You successfully registered your account.');
        return redirect()->route('signin')->setStatusCode(201);
    }

    public function SignInUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|exists:users',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email is required',
            'email.exists' => 'Email does not exist',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            flash()->error($message);
            return redirect()->back()->withInput()->setStatusCode(422);
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            flash()->error('Invalid credentials');
            return back()->withInput()->setStatusCode(401);
        }

        Auth::login($user);
        sweetalert()->success('Welcome back, ' . $user->name . '!');
        return redirect()->route('home')->setStatusCode(200);
    }

    public function SignOutUser(Request $request) {
        Auth::logout();
        sweetalert()->success('You have successfully logged out.');
        return redirect()->route('home')->setStatusCode(200);
    }
}
