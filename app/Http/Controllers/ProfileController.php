<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function adminEdit($id):View
    {
        $user = User::find($id);
        
        if (!$user) {
            // Handle the case where the user with the given ID is not found
            // You can return a 404 error or a custom error page.
        }

        return view('profile.adminEdit', [
            'user' => $user,
        ]);
    }
      /**
     * Create user form.
     */
    public function create(): View
    {
        return view('profile.createUser');
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

        /**
     * Update the user's profile information.
     */
    public function adminUpdate(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::find($id);
    
        if (!$user) {
            // Handle the case where the user with the given ID is not found
            // You can return a 404 error or a custom error page.
        }
    
        $user->fill($request->validated());
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();

        return Redirect::route('admin.edit', ['id' => $user->id])->with('status','profile-updated');
        
    }
    /**
     * Delete the user's account.
     */
    public function destroyOtherAccount(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::find($id);
    
        if (!$user) {
            // Handle the case where the user with the given ID is not found
            // You can return a 404 error or a custom error page.
        }else{
            $user->delete();
        }

        return Redirect::route('users.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    //create new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Make sure 'users' matches your actual table name.
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'lng' => ['required', 'numeric'], // Correct the spelling of 'required' and 'numeric'
            'lat' => ['required', 'numeric'], // Correct the spelling of 'required' and 'numeric'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lng' => $request->lng,
            'lat' => $request->lat,
        ]);

        return redirect()->route('users.index') // Redirect to a page after successful user creation.
            ->with('success', 'User created successfully'); // Flash a success message.
    }
}
