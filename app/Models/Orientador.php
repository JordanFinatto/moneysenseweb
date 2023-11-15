<?php

namespace App\Models;

class Orientador extends BaseModel
{
    protected $table = 'orientador';

    protected $fillable = [
        'idCidade',
        'nome',
        'telefone',
        'especializacao',
        'criador',
        'alterador',
        'situacao',
    ];

    protected $casts = [
        'idCidade' => 'integer',
        'nome' => 'string',
        'telefone' => 'string',
        'especializacao' => 'string',
        'criador' => 'integer',
        'alterador' => 'integer',
        'situacao' => 'integer',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'id', 'idCidade');
    }

    public function topicos()
    {
        return $this->hasMany(Topico::class, 'idOrientador', 'id');
    }

    public static function findAll(): array
    {
        $orientadoresDb = parent::findAll();
        $orientadores = [];

        if ($orientadoresDb)
        {
            foreach ($orientadoresDb as $orientadorDb)
            {
                $cidade = \App\Models\Cidade::findOneById($orientadorDb->idCidade);

                $orientadorDb->cidadeDescription = $cidade->nome;

                $orientadores[] = $orientadorDb;
            }
        }

        return $orientadores;
    }
}
