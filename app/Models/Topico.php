<?php

namespace App\Models;

class Topico extends BaseModel
{
    protected $table = 'topico';

    protected $fillable = [
        'idOrientador',
        'titulo',
        'conteudo',
        'criador',
        'alterador',
        'situacao',
    ];

    protected $casts = [
        'idOrientador' => 'integer',
        'titulo' => 'string',
        'conteudo' => 'string',
        'criador' => 'integer',
        'alterador' => 'integer',
        'situacao' => 'integer',
    ];

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, 'id', 'idOrientador');
    }

    public function alterador()
    {
        return $this->belongsTo(Usuario::class, 'id', 'alterador');
    }

    public static function findAll(): array
    {
        $topicosDb = parent::findAll();
        $topicos = [];

        if ($topicosDb)
        {
            foreach ($topicosDb as $topicoDb)
            {
                $nomeOrientador = '-';

                if ($topicoDb->idOrientador)
                {
                    $orientador = \App\Models\Orientador::findOneById($topicoDb->idOrientador);
                    $nomeOrientador = $orientador->nome;
                }

                $topicoDb->orientadorDescription = $nomeOrientador;
                $topicos[] = $topicoDb;
            }
        }

        return $topicos;
    }

    public static function getOrientadoresAtivos($idTopico = NULL)
    {
        $topico = \App\Models\Topico::findOneById($idTopico);
        $idOrientaor = $topico ? $topico->idOrientador :0;

        return \App\Models\Orientador::query()
            ->where('id', '=', $idOrientaor)
            ->orWhere('situacao', '=', true)
            ->get();
    }
}
