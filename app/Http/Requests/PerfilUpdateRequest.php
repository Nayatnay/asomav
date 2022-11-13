<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilUpdateRequest extends FormRequest
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
        $perfil = $this->route('perfil');        
        return [
            'ci' => ['required', 'unique:users,ci,' . $perfil->id],
            'name' => 'required',
            'email' => ['required', 'unique:users,email,' . request()->route('perfil')->id],
            'telf' => 'required',
            'calle' => 'required',
            'casa' => ['required', 'unique:users,casa,' . $perfil->id],
            'alicuota' => 'required',
            'email_verified_at' => 'required',
            'password' => ['required', 'min:8'],
            'remember_token' => 'required'
        ];
    }
}
