<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function showLogin()
    {
        return view('login');
    }


    public function login()
    {
        $credentials = request()->only('email', 'password');

        if (auth()->attempt($credentials)) {

            return redirect()->intended('/email/send'); // Redirect to a protected page
        }

        // Authentication failed
        return redirect('/login')->with('error', 'Invalid email or password');
    }
    public function register()
    {
        $formData = request()->validate([
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required','confirmed', 'min:3'],
        ]);

        $formData['password'] = bcrypt($formData['password']);

        $user = User::create($formData);

        $user->notify(new EmailVerificationNotification($user));
        return redirect('/email/verify')->with('newUser', true);
    }
}
