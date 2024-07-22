<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return view('dashboard.pages.user.index', compact('users'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching users: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('dashboard.pages.user.create');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while showing the create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'no_hp' => 'required|string|max:15',
                'instansi' => 'nullable|string|max:255',
                'isAdmin' => 'required|boolean',
            ]);

            // Create a new user
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'no_hp' => $validated['no_hp'],
                'instansi' => $validated['instansi'],
                'isAdmin' => $validated['isAdmin'],
            ]);

            // Redirect with success message
            return redirect()->route('user.index')->with('success', 'User successfully created.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('dashboard.pages.user.show', compact('user'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching the user: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('dashboard.pages.user.edit', compact('user'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching the user for edit: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:6',
                'no_hp' => 'required|string|max:20',
                'instansi' => 'required|string|max:255',
                'isAdmin' => 'required|boolean',
            ]);

            $user = User::findOrFail($id);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }
            $user->no_hp = $validated['no_hp'];
            $user->instansi = $validated['instansi'];
            $user->isAdmin = $validated['isAdmin'];
            $user->save();

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating the user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', 'The user has related assets or transactions and cannot be deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the user: ' . $e->getMessage());
        }
    }
}
