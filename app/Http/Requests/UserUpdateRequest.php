<?php

namespace App\Http\Requests;
 
use App\Http\Requests\Api\FormRequestSuport;
 
 

//use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequestSuport
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
        

        //validações para campos obrigatórios   
        return [
            'name' => 'required',
            'email' => 'required|email|',
            'password' => 'required|min:8',
             
        ];

    }
    
    //Menssagens Personalizadas
    public function messages()
    {
    return [
        'name.required' => 'Requer o seu nome',
        'email.required' => 'Requer o seu email',
        'email.email' => 'Email inválido',
        'password.required' => 'Requer a sua senha',
        'password.min' => 'A senha precisa ter no mínimo oito caractéres',
        ];
    }

    
}
