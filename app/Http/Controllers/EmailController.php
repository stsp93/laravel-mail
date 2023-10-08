<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Exception;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendIndex()
    {
        return view('email/send');
    }

    public function verifyIndex()
    {
        return view('email/verify');
    }

    public function resend()
    {
        request()->user()->notify(new EmailVerificationNotification(request()->user()));

        return view('email/verify')->with('resend', true);
    }

    public function verify($id, $hash)
    {
        $user = User::find($id);

        // Check if user is not already verified
        if ($user->hasVerifiedEmail()) {
            return redirect('/email/send');
        }

        // Verify the user's email and login
        $user->markEmailAsVerified();
        auth()->login($user);

        return redirect('/email/send');
    }

    public function send()
    {
        try {
            $validatedData = request()->validate([
                'recepient' => ['required', 'email'],
                'subject' => ['required'],
                'content' => ['required'],
            ]);
            $email = $validatedData['recepient'];
            $title = $validatedData['subject'];
            $content = $validatedData['content'];

            // Send the email 
            Mail::to($email)->send(new NotificationEmail($title, $content));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
