<?php

namespace App\Http\Controllers;

use App\Models\User; // or App\Models\Admin if using a separate table/model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Automatic Validation & CSRF Handling
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks against 'password_confirmation'
        ]);

        // 2. Create the User (Password is hashed automatically or using Hash::make)
        User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3. Redirect with success message
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
}