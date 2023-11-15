<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TopicoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'conteudo' => ['required', 'string', 'min:50'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator)
            {
                if ($validator->errors()->has('titulo'))
                {
                    $validator->errors()->forget('titulo');

                    $validator->errors()->add(
                        'Título ',
                        'Título inválido!'
                    );
                }
                else if ($validator->errors()->has('conteudo'))
                {
                    $validator->errors()->forget('conteudo');

                    $validator->errors()->add(
                        'conteudo ',
                        'O conteúdo deve possuir ao menos 50 caracteres!'
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
