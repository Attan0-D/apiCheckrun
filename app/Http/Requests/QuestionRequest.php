<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequestSuport;

class QuestionRequest extends FormRequestSuport
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'description.required' => 'Campo Descrição obrigatório'
        ];
    }
}
