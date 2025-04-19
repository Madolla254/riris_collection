<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }
   
    public function showregister(){
        return view('auth.register');
    }
    public function register(Request $request){
        $validated=$request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone'=> 'required|string|max:15',
                'password' => 'required|string|min:8|confirmed',
            ]
        );
        $user=User::create($validated);
        Auth::login($user);
        return redirect()->route('home')->with('success','Registration successful');

        // Handle the registration logic here
        // Validate the request, create a new user, etc.
        // Redirect to the intended page or show an error message
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out.');
        
    }

    public function login(Request $request)
    {
        $validated=$request->validate(
            [
            
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );
        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('home')->with('success','Logged in successfully');
        }else{
    
        throw ValidationException::withMessages(
            [
                'credentials' => 'The provided credentials do not match our records.',
            ]
        );}
    }


}
