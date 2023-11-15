<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientadorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrientadorController extends Controller
{
    public function create(OrientadorRequest $request)
    {
        $orientador = new \App\Models\Orientador();
        $orientador->fill([
            'idCidade' => $request->idCidade,
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'especializacao' => $request->especializacao,
            'situacao' => $request->situacao,
            'criador' => Auth::id(),
            'alterador' => Auth::id(),
        ]);

        $orientador->save();

        return Redirect::route('orientador.listagem')->with('sucesso', 'Orientador registrado com sucesso.');
    }

    public function update(OrientadorRequest $request)
    {
        debug($request->telefone);

        $orientador = \App\Models\Orientador::findOneById($request->id);
        $orientador->idCidade = $request->idCidade;
        $orientador->nome = $request->nome;
        $orientador->telefone = $request->telefone;
        $orientador->especializacao = $request->especializacao;
        $orientador->situacao = $request->situacao;
        $orientador->alterador = Auth::id();
        $orientador->update();

        return Redirect::route('orientador.listagem')->with('sucesso', 'Orientador salvo com sucesso.');
    }
}
