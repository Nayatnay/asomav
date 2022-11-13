<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saldo;
use App\Models\Ctasc;

use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($usuario)
    {

        $usuario = User::where('id', '=', $usuario)->first();

        $saldo = Saldo::where('user_id', '=', $usuario->id)->first();

        return view('saldos.edit', compact('usuario', 'saldo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saldo $saldo)
    {

        $saldo->cargo = $request->cargo;
        $saldo->save();

        $usuario = user::where('id', '=', $saldo->user_id)->first();

        $ctasc = Ctasc::where('user_id', '=', $usuario->id)
            ->where('restriccion', '=', 0)->get();
        $total = 0;

        $saldo = Saldo::where('user_id', '=', $usuario->id)->get();

        return redirect()->route('usuarios-cxc', compact('usuario', 'ctasc', 'total', 'saldo'));
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
