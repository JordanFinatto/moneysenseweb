<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UsuarioRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['string', 'max:255', 'min:5'],
            'email' => ['email', 'max:255', Rule::unique(Usuario::class)->ignore($this->input('id'))],
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
                    $validator->errors()->add('nome ', 'O Nome deve possuir ao menos 5 caracteres!');
                }
                else if ($validator->errors()->has('email'))
                {
                    $validator->errors()->forget('email');

                    $email = $this->input('email');
                    $msg = 'Email inválido!';

                    if (strlen($email) <= 10)
                    {
                        $msg = 'O Email deve ser maior que 10 caracteres!';
                    }
                    else
                    {
                        $emailExist = \App\Models\Usuario::query()
                            ->where('email', '=', $email)
                            ->where('id', '<>', $this->input('id'))
                            ->first();

                        if ($emailExist)
                        {
                            $msg = 'Email já cadastrado!';
                        }
                    }

                    $validator->errors()->add('email', $msg);
                }
                else if ($validator->errors()->count())
                {
                    $validator->errors()->add('Ops... ', 'Algo inesperado aconteceu, tente novamente!');
                }
            }
        ];
    }
}
