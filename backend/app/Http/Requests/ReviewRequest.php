<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReviewRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|max:20",
            "text" => "required|max:50",
            "amount" => 'numeric',
            "user_id" => "exists:users,id",
            "bootcamp_id" => "exits:bootcamps,id"
        ];

    }
    /**
     * 
     * enviar respuesta en caso de validacion fallida
     */

    protected function failedValidation(Validator $v){
        //lanzar excepcion http responsr en cada 

        throw new HttpResponseException(response()->json([
                                        "success" => false,
                                        "errors" => $v->errors()
        ], 422));

    }
}
