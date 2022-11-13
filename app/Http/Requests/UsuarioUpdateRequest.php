<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
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
        $user = $this->route('usuario');
        return [
            'ci' => ['required', 'unique:users,ci,' . $user->id],
            'name' => 'required',
            'email' => ['required', 'unique:users,email,' . request()->route('usuario')->id],
            'telf' => 'required',
            'calle' => 'required',
            'casa' => ['required', 'unique:users,casa,' . $user->id],
            'alicuota' => 'required',
            'email_verified_at' => 'required',
            'password' => 'required', 
            'remember_token' => 'required'
        ];
    }
}
