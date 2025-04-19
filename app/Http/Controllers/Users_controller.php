<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users_controller extends Controller
{
    //show login form
   


    public function register()
    {
        return view('register');
    }
    public function profile()
    {
        return view('profile');
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
