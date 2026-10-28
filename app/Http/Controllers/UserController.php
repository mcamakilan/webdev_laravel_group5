<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of all registered user accounts
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && in_array($request->role, ['admin', 'student'])) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form to create a new user account
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user account with auto-generated passwords
     */
    public function store(Request $request)
    {
        $request->validate([
            'role'             => ['required', Rule::in(['admin', 'student'])],
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'student_number'   => ['nullable', 'required_if:role,student', 'string', 'max:50', 'unique:users,student_number'],
            'college_program'  => ['nullable', 'required_if:role,student', 'string', 'max:255'],
            'year_and_section' => ['nullable', 'required_if:role,student', 'string', 'max:50'],
        ]);

        // Auto-generate password
        $rawPassword = Str::ucfirst(Str::random(3)) . '#' . rand(10, 99) . Str::lower(Str::random(2)) . '!';

        User::create([
            'role'             => $request->role,
            'name'             => trim($request->first_name . ' ' . $request->last_name),
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => strtolower($request->email),
            'student_number'   => $request->role === 'student' ? $request->student_number : null,
            'college_program'  => $request->role === 'student' ? $request->college_program : null,
            'year_and_section' => $request->role === 'student' ? $request->year_and_section : null,
            'password'         => Hash::make($rawPassword),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', ucfirst($request->role) . ' account created! Generated Password: ' . $rawPassword);
    }

    /**
     * Delete a user account
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own active admin account!');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User account "' . $userName . '" deleted successfully.');
    }
}