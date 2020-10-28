<?php

namespace App\Http\Requests;
 
use App\Http\Requests\Api\FormRequestSuport;
 
 

//use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequestSuport
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
            
             
        ];

    }
    
    //Menssagens Personalizadas
    public function messages()
    {
    return [
        'name.required' => 'Requer o nome da categoria',
     
        ];
    }

    
}
