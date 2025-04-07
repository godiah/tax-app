<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function sendEmail(Request $request)
    {
        try {
            $request->validate([
                'name'    => 'nullable|string|max:255',
                'email'   => 'required|email',
                'message' => 'required|string',
                'phone' => 'string|nullable'
            ]);

            $details = [
                'name'    => $request->name,
                'email'   => $request->email,
                'message' => $request->message,
                'phone' => $request->phone,
            ];

            Mail::raw('Thank you for reaching out our team will get back to you as soon as possible.', function ($message) use ($details) {
                $message->to($details['email'])
                        ->subject('Enquiry Submission');
            });

            // Send email to business owner
            Mail::to('taxgen.ke@gmail.com')->send(new ContactMail($details));

            if (Mail::failures()) {
                Log::error('Mail sending failed: ' . implode(', ', Mail::failures()));
            }

            return back()->with('success', 'Your enquiry has been sent successfully!');
        } catch(\Exception $e) {
            return back()->with('error', 'There was an issue sending your message. Please try again later.');
        }
    }
}
