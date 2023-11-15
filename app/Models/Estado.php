<?php

namespace App\Models;

class Estado extends BaseModel
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'estado';

    protected $fillable = [
        'nome',
        'ur',
    ];

    protected $casts = [
        'nome' => 'string',
        'uf' => 'string',
    ];

    public function cidades()
    {
        return $this->hasMany(Cidade::class, 'idEstado', 'id');
    }
}
