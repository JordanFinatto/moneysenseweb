<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'usuario_senha' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'usuario_senha' => Hash::make($validated['usuario_senha']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
