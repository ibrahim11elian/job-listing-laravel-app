<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(Request $request){

        return view('auth.login');
    }

    public function store(Request $request){
       $validatedValues = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validatedValues)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
        $request->session()->regenerate();
        return redirect('/jobs');
    }

    public function destroy(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
