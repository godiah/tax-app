<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('/send-enquiry', [ContactController::class, 'sendEmail'])->name('contact.send');
