<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SubscriptionIntroMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    //
    public function subscribe(Request $request)
    {
        //Log::info('Subscription request received: ' . $request->email);
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'verification_token' => Str::random(32),
            'status' => 'subscribed'
        ]);

        // Log::info('New subscriber created: ' . $subscriber->email);

        // Send verification email
        // TODO: Implement email verification
        Mail::to($subscriber->email)->queue(new SubscriptionIntroMail($subscriber));

        return response()->json([
            'message' => 'Thank you for subscribing! Please check your email to confirm your subscription.'
        ]);
    }
}
