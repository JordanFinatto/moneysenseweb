<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'usuario_nome' => ['required', 'string', 'max:255'],
            'usuario_email' => ['required', 'string', 'email', 'max:255', 'unique:'.Usuario::class],
            'usuario_senha' => ['required', 'confirmed', Rules\Password::defaults()],
            'usuario_admin'  => ['required', 'int'],
            'usuario_aceitepoliticaprivacidade' => ['required', 'int'],
        ]);

        $user = Usuario::create([
            'usuario_nome' => $request->name,
            'usuario_email' => $request->email,
            'usuario_senha' => Hash::make($request->password),
            'usuario_admin' => 0,
            'usuario_aceitepoliticaprivacidade' => $request->aceitepoliticaprivacidade,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
