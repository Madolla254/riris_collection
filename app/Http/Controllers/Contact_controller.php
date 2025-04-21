<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class Contact_controller extends Controller
{
    public function contactSubmit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact=new Contact();
        $contact->name=$request->input('name');
        $contact->email=$request->input('email');
        $contact->message=$request->input('message');
        $contact->save();
        // Send an email to contact email
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => "We have received your feedback. We will be in touch",
        ];
    
        Mail::to($request->input('email'))->send(new ContactMail($data));
    
        


        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function showContactForm()
    {
        return view('contact');
    }
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
