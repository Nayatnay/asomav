<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BuzonMailable;
use App\Mail\EnviosMailable;
use Illuminate\Support\Facades\Mail;
use App\Models\Ctasc;
use App\Models\User;
use App\Models\Factura;
use App\Models\Temporal;


class BuzonController extends Controller
{
    public function index()
    {
        return view('contactanos.buzon');
    }

    public function store(request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telf' => 'required',
            'calle' => 'required',
            'casa' => 'required',
            'consulta' => 'required',
        ]);

        $correo = new BuzonMailable($request->all());  //le estoy mandando informacion al constructor del Mailable
        Mail::to('asomavilla2009@gmail.com')->send($correo);

        return redirect()->route('buzon.index')->with('info', 'mensaje enviado');
    }

    public function enviosMASIVOS(request $request)
    {
        Temporal::truncate();

        $ctasc = Ctasc::where('restriccion', '=', 0)->get();

        if ($ctasc === null) {
            return redirect()->route('ver-ctasxc');
        }

        foreach ($ctasc as $cuentas) {
            
            $users = User::where('id', '=', $cuentas->user_id)->first();
            $factura = Factura::where('id', '=', $cuentas->factura_id)->first();

            $temporal = new Temporal();
            $temporal->nombre = $users->name;
            $temporal->periodo = $factura->periodo;
            $temporal->save();

            $correo = new EnviosMailable($temporal);  //le estoy mandando informacion al constructor del Mailable
            Mail::to($users->email)->send($correo);
        }

        return redirect()->route('ver-ctasxc')->with('info', 'mensaje enviado');
    }
}
