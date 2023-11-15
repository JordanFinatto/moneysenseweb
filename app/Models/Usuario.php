<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table  = 'usuario';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'admin',
        'aceitePoliticaPrivacidade',
        'criador',
        'alterador',
        'situacao',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public static function findOneById($id)
    {
        $class = get_called_class();

        if (property_exists($class, 'table'))
        {
            $model = new $class;

            return $model::query()
                ->where('id', '=', $id)
                ->first();
        }

        return null;
    }
}
