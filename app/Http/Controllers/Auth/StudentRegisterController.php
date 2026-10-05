<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentRegisterController extends Controller
{
    /**
     * Handle an incoming student registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate incoming form inputs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Create the new student account in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => 'student', // Uncomment if you have a 'role' column in your users table
        ]);

        // 3. Fire Laravel's standard Registered event
        event(new Registered($user));

        // 4. Log the student in
        Auth::login($user);

        // 5. Regenerate the session ID for security
        $request->session()->regenerate();

        // 6. Redirect to the dashboard
        return redirect()->intended(route('dashboard'));
    }
}