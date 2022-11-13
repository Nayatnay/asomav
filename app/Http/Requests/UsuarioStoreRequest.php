<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
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
            'ci' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|unique:users',
            'telf' => 'required',
            'calle' => 'required',
            'casa' => 'required|unique:users',
            'alicuota' => 'required',
            'deuda' => 'required',
            'email_verified_at' => 'required',
            'password' => 'required',
            'remember_token' => 'required'
        ];
    }
}
