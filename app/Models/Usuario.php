<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario';

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
        return self::query()
            ->where('id', '=', $id)
            ->first();
    }

    public static function findAll()
    {
        $users = self::query()
            ->where('id', '<>', Auth::id())
            ->orderBy('updated_at', 'DESC')
            ->get();

        foreach ($users as $user)
        {
            if ($user->alterador)
            {
                $alterador = self::findOneById($user->alterador);
                $user->alteradorDescription = $alterador->nome;
            }

            $criador = self::findOneById($user->criador);

            $user->criadorDescription = $criador->nome;
            $user->created_atDescription = date_create($user->created_at)->format('d/m/Y H:i');
            $user->updated_atDescription = date_create($user->updated_at)->format('d/m/Y H:i');
        }

        return $users;
    }
}
