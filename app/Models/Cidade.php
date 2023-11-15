<?php

namespace App\Models;

class Cidade extends BaseModel
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'cidade';

    protected $fillable = [
        'idEstado',
        'nome',
    ];

    protected $casts = [
        'idEstado' => 'integer',
        'nome' => 'string',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id', 'idEstado');
    }

    public function orientadores()
    {
        return $this->hasMany(Orientador::class, 'idCidade', 'id');
    }
}
