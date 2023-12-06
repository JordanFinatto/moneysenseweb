<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $primaryKey = 'id';

    public static function findAll()
    {
        $class = "\\" . get_called_class();

        $model = new $class;

        if ($model instanceof \App\Models\Cidade || $model instanceof \App\Models\Estado)
        {
            $models = $class::query()
                ->get();
        }
        else
        {
            $models = $class::query()
                ->orderBy('updated_at', 'DESC')
                ->get();
        }


        foreach ($models as $model)
        {
            if (isset($model->alterador) && $model->alterador)
            {
                $user = \App\Models\Usuario::findOneById($model->alterador);
                $model->alteradorDescription = $user->nome;
            }

            if (isset($model->criador) && $model->criador)
            {
                $user = \App\Models\Usuario::findOneById($model->criador);
                $model->criadorDescription = $user->nome;
            }

            if (isset($model->created_at) && $model->created_at)
            {
                $model->created_atDescription = date_create($model->created_at)->format('d/m/Y H:i');
            }

            if (isset($model->updated_at) && $model->updated_at)
            {
                $model->updated_atDescription = date_create($model->updated_at)->format('d/m/Y H:i');
            }
        }

        return $models;
    }

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
