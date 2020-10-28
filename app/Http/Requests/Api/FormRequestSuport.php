<?php
namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Classe responsável por extender os métodos do FormRequest e também modificar o retorno dos dados de validacao
 */
class FormRequestSuport extends FormRequest {
    /**
     * Método responsável por alterar o retorno da validação do form request
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    { 
        throw new HttpResponseException(response()->json($validator->errors(), 422));    
    }
}