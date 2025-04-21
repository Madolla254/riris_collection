<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users_controller extends Controller
{
    //show login form
   


    public function register()
    {
        return view('register');
    }
    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();
        $orders=Orders::where('user_id',$user->id)->simplePaginate(20);
        //get user orders which are not completed
        $incomplete_orders=Orders::where('user_id',$user->id)->where('status','!=','completed')->where('status','!=','canceled')->where('status','!=','returned')->simplePaginate(20);
        return view('profile', compact('user', 'orders','incomplete_orders'));
    }
    public function logout()
    {
        return view('logout');
    }
    public function forgotPassword()
    {
        return view('forgot-password');
    }
    public function resetPassword()
    {
        return view('reset-password');
    }
    public function verifyEmail()
    {
        return view('verify-email');
    }
    public function sendVerificationEmail()
    {
        return view('send-verification-email');
    }
    public function updateProfile()
    {
        return view('update-profile');
    }
    public function deleteAccount()
    {
        return view('delete-account');
    }
    public function changePassword()
    {
        return view('change-password');
    }
    public function twoFactorAuthentication()
    {
        return view('two-factor-authentication');
    }
    

    //admin pages

    public function admin_login(){
        return view('admin.login');
    }
}
