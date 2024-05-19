<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();
        $organizations = Organization::all();
        return view('admin.users.form', compact('roles', 'organizations'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'role_id' => 'required|exists:roles,role_id',
            'organization_id' => 'required|exists:organizations,organization_id',
        ]);

        // Hash the password before storing
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::create($validated);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        $organizations = Organization::all();
        return view('admin.users.form', compact('user', 'roles', 'organizations'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'role_id' => 'required|exists:roles,role_id',
            'organization_id' => 'required|exists:organizations,organization_id',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Do not update the password if it is not provided
        }

        $user->update($validated);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
