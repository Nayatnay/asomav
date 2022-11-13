<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PerfilUpdateRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = auth()->user();
        return view('perfil.index', compact('perfil'));
    }
  
     public function edit(User $perfil)
    {
        return view('perfil.edit', compact('perfil'));
        //return $usuarios;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilUpdateRequest $request, User $perfil)
    { 
        $perfil->ci = $request->ci;
        $perfil->name = $request->name;
        $perfil->slug = Str::slug($request->name, '-');
        $perfil->email = $request->email;
        $perfil->telf = $request->telf;
        $perfil->calle = $request->calle;
        $perfil->casa = $request->casa;
        $perfil->alicuota = $request->alicuota;;
        $perfil->email_verified_at = now();
        $perfil->password = $request->password;
        $perfil->remember_token = $request->remember_token;

        if ($request->newpassword <> null) {
            $perfil->password = bcrypt($request->newpassword, ['$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        }
        
    // $perfil->update($request->all()); Actualizacion masiva

        $perfil->save();
        return redirect()->route('perfil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
