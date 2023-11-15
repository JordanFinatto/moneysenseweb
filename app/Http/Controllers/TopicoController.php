<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class TopicoController extends Controller
{
    public function create(TopicoRequest $request)
    {
        \App\Models\Topico::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'idOrientador' => $request->idOrientador,
            'situacao' => $request->situacao,
            'criador' => Auth::id(),
            'alterador' => Auth::id(),
        ]);

        return Redirect::route('topico.listagem')->with('sucesso', 'Tópico registrado com sucesso.');
    }

    public function update(TopicoRequest $request)
    {
        \App\Models\Topico::query()
        ->where('id', '=', $request->id)
        ->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'idOrientador' => $request->idOrientador,
            'situacao' => $request->situacao,
            'alterador' => Auth::id(),
        ]);

        return Redirect::route('topico.listagem')->with('sucesso', 'Tópico salvo com sucesso.');
    }
}
