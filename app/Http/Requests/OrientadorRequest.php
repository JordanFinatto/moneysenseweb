<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class OrientadorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'idCidade' => ['required', 'integer'],
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'min:11', 'max:45'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator)
            {
                if ($validator->errors()->has('nome'))
                {
                    $validator->errors()->forget('nome');
                    $validator->errors()->add(
                        'nome ',
                        'Nome do orientador inválido!'
                    );
                }
                else if ($validator->errors()->has('telefone'))
                {
                    $validator->errors()->forget('telefone');
                    $validator->errors()->add(
                        'telefone ',
                        'Telefone do orientador inválido!'
                    );
                }
                else if ($validator->errors()->has('idCidade'))
                {
                    $validator->errors()->forget('idCidade');
                    $validator->errors()->add(
                        'idCidade ',
                        'Cidade selecionada inválida!'
                    );
                }
                else if ($validator->errors()->count())
                {
                    $validator->errors()->add(
                        'Ops... ',
                        'Algo inesperado aconteceu, tente novamente!'
                    );
                }
            }
        ];
    }
}
