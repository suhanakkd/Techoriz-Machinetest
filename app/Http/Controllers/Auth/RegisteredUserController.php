<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:0,1'], // Validate role as 0 or 1
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

         // Send the thank-you email
        
    try {
        Mail::to('suhanakkd@gmail.com')->send(new UserRegisterMail($user));
        session()->flash('success', 'Registration successful, and the thank-you email has been sent.');
    } catch (\Exception $e) {
        session()->flash('error', 'Registration successful, but the thank-you email could not be sent. Please contact support.');
    }

       // Redirect based on role
    if ($user->role == 1) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
    }
}
