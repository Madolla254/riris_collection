<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
                'phone'=> 'required|numeric',
                'password' => 'required|string|min:8|confirmed',
            ]
        );
        $validated['name']=ucwords($validated['name']);
        $validated['password']=bcrypt($validated['password']);
        $user=User::create($validated);
        //send email
        Mail::to($validated['email'])->send(new \App\Mail\WelcomeMail($user));
        Auth::login($user);
        return redirect()->route('home')->with('success','Registration successful');

    
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

    public function showResetPassword()
    {
        return view('auth.request_password');
    }
    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

    
       //validate the email
        $validated=$request->validate([
            'email' => 'required|email',
        ]);

        //check if the email exists in the database
        $user=User::where('email',$validated['email'])->first();
        if(!$user){
            return redirect()->back()->with('error','Email not found');
        }else{
        //generate a token
        $token=bin2hex(random_bytes(50));
        //store the token in the database
        $user->update(['remember_token'=>$token]);
        //create a password reset link
        $resetLink=url('/password/reset/new?token='.$token.'&email='.$validated['email']);
        //send the reset link to the email
        Mail::to($validated['email'])->send(new \App\Mail\PasswordResetMail($resetLink));

        return redirect()->back()->with('success','Password reset link sent to your email');

        //return a response
         //send the reset link
        }
    }
    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        return view('auth.reset_password', compact('token', 'email'));
    }
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);
        // Find the user by email
        $user = User::where('email', $validated['email'])->first();
        if (!$user || $user->remember_token !== $validated['token']) {
            return redirect()->back()->with('error', 'Invalid token or email');
        }else{
        // Update the user's password
        $user->password = bcrypt($validated['password']);
        $user->remember_token = null; // Clear the token after use
        $user->save();


        return redirect()->route('login')->with('success', 'Password reset successfully');
        }
    }


}
