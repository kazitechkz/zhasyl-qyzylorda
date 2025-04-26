<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    public function check()
    {
        $validated = request()->validate([
            'password' => 'required',
            // other rules here
        ]);
        // take it from users table or where you're going to store passwords
        $hashedOriginal = Hash::make('1221');

        $isPasswordValid = Hash::check($validated['password'], $hashedOriginal);
        if (!$isPasswordValid) {
            return redirect('access');
        }
        request()->session()->put('token', $hashedOriginal);
        return redirect('/');
    }
}
