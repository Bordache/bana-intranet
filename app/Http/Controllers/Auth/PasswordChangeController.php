<?php

namespace App\Http\Controllers\Auth;

use App\Models\PasswordInit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordChangeController extends Controller
{
    public function edit()
    {
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Mettre à jour le mot de passe de l'utilisateur
        $user = auth()->user();
        $user->password = Hash::make($validated['password']);
        $user->password_changed = true;
        $user->save();

        // Supprime password_init
        PasswordInit::where('user_id', $user->id)->delete();

        return redirect()->route('dashboard')->with('success', 'Mot de passe changé avec succès.');
    }
}
