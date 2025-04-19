<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

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

    public function delete(Request $request): RedirectResponse
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403, 'No autorizado');
        }
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return redirect()->route('users_admin')->with('success', 'Usuario eliminado correctamente');
        } else {
            return redirect()->route('users_admin')->with('error', 'Usuario no encontrado');
        }
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);
    
        $user->role_id = $request->role_id;
        $user->save();
    
        return Redirect::route('users_admin')->with('success', 'Rol actualizado correctamente');
    }
}
