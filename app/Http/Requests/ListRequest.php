<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequestSuport;

class ListRequest extends FormRequestSuport
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'name'=> 'required',
            'hour' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome da lista é obrigatório',
            'hour.required'=> 'Data e Hora é obrigatório',
            

        ];
    }
}
