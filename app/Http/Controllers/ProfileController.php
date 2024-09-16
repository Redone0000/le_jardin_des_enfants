<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


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
        $user = $request->user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Mise à jour des informations de l'enseignant, si lié
        $teacher = $user->teacher;

        if ($teacher) {
            // Mettez à jour les informations du modèle Teacher ici
            $teacher->fill($request->only(['description', 'picture']));

            // Gestion de l'image
            if ($request->hasFile('picture')) {
                // Suppression de l'ancienne photo si elle existe
                if ($teacher->picture) {
                    Storage::disk('public')->delete($teacher->picture);
                }
                // Sauvegarde de la nouvelle photo
                $teacher->picture = $request->file('picture')->store('pictures', 'public');
            }

            $teacher->save();
        }

        $tutor = $user->tutor;

        if ($tutor) {
            // Mettez à jour les informations du modèle Teacher ici
            $tutor->fill($request->only(['address', 'emergency_contact_name', 'emergency_contact_phone']));

            $tutor->save();
        }

        return Redirect::route('profile.show')->with('status', 'profile-updated');
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

    /**
     * Afficher le profil de l'utilisateur authentifié.
     */
    public function show()
    {
        $user = Auth::user();
        $role = $user->role_id;

        return view('profile.show', compact('user','role'));
    }

    public function showChangePasswordForm()
    {
        return view('profile.changepassword');
    }

    public function changePassword(Request $request) 
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'L\'ancien mot de passe est incorrect!']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.password.form')->with('success', 'Mot de passe modifié avec succès');
    }
}
