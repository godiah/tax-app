<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class UnsubscribeController extends Controller
{
    public function unsubscribe($token)
    {
        // $subscriber = Subscriber::where('verify_token', $token)->first();

        // if (!$subscriber) {
        //     return view('newsletter.invalid-token');
        // }

        // $subscriber->delete();

    }
}
