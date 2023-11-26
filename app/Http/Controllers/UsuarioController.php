<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{
    public function create(UsuarioRequest $request)
    {
        \App\Models\Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => $request->admin,
            'aceitePoliticaPrivacidade' => false,
            'situacao' => $request->situacao,
            'criador' => Auth::id(),
            'alterador' => Auth::id(),
        ]);

        return Redirect::route('usuario.listagem')->with('sucesso', 'Usuário registrado com sucesso.');
    }

    public function update(UsuarioRequest $request)
    {
        $values['nome'] = $request->nome;
        $values['email'] = $request->email;
        $values['admin'] = $request->admin;
        $values['situacao'] = $request->situacao;

        if ($request->password)
        {
            $values['password'] = Hash::make($request->password);
        }

        \App\Models\Usuario::query()
            ->where('id', '=', $request->id)
            ->update($values);

        return Redirect::route('usuario.listagem')->with('sucesso', 'Usuário salvo com sucesso.');
    }
}
