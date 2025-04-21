<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class sendEmail extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    
        Mail::to($request->email)->send(new ContactMail($data));
    
        return back()->with('success', 'Email sent successfully!');
    }
}
