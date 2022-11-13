<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pago;
use App\Models\Ctasc;
use App\Models\Saldo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\PagoStoreRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Ctasi;
use App\Models\Factura;
use App\Models\Movimiento;
use App\Models\Reserva;
use PhpParser\Node\Stmt\Return_;

class UsuarioController extends Controller

{
    public function __construct()
    {
        $this->Middleware('can:usuarios.index')->only('index');
        $this->Middleware('can:usuarios.create')->only('create', 'store');
        $this->Middleware('can:usuarios.edit')->only('edit', 'update');
        $this->Middleware('can:usuarios.destroy')->only('destroy');
        $this->Middleware('can:usuarios-cxc')->only('usuariosCXC');
        $this->Middleware('can:usuarios-mov')->only('usuariosMOV');
    }

    public function index(Request $request)

    {
        $buscar = $request->buscar;

        $usuarios = User::where('ci', 'LIKE', '%' . $buscar . '%')
            ->orwhere('name', 'LIKE', '%' . $buscar . '%')
            ->orwhere('calle', 'LIKE', '%' . $buscar . '%')
            ->orwhere('casa', 'LIKE', '%' . $buscar . '%')
            ->orwhere('email', 'LIKE', '%' . $buscar . '%')
            ->orwhere('telf', 'LIKE', '%' . $buscar . '%')
            ->orwhere('alicuota', 'LIKE', '%' . $buscar . '%')->get()->sortBy(['calle', 'casa']);

        return view('usuarios.index', compact('usuarios', 'buscar'));
    }

    public function create()

    {
        return view('usuarios.add');
    }

    public function edit(User $usuario)

    {
        return view('usuarios.edit', compact('usuario'));
    }


    public function store(UsuarioStoreRequest $request)

    {
        $usuario = new User();

        $usuario->ci = $request->ci;
        $usuario->name = $request->name;
        $usuario->slug = Str::slug($request->name, '-');
        $usuario->email = $request->email;
        $usuario->telf = $request->telf;
        $usuario->calle = $request->calle;
        $usuario->casa = $request->casa;
        $usuario->alicuota = $request->alicuota;;
        $usuario->email_verified_at = now();
        $usuario->password = bcrypt('00000000', ['$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        $usuario->remember_token = $request->remember_token;

        $usuario->AssignRole('comun');

        //$usuario = User::create($request->all()); // carga masiva ----- salva todas las propiedades de nuestro objeto User en la variable $usuario*/

        $usuario->save();

        $fechact = now();
        $saldo = new Saldo();
        $saldo->user_id = $usuario->id;
        $saldo->fecha = now()->format('Y-m-d');
        $saldo->descripcion = "Deuda Anterior";
        $saldo->cargo = $request->deuda;
        $saldo->abono = 0;

        $saldo->save();

        return redirect()->route('usuarios.index');
    }

    public function update(UsuarioUpdateRequest $request, User $usuario)

    {
        $usuario->ci = $request->ci;
        $usuario->name = $request->name;
        $usuario->slug = Str::slug($request->name, '-');
        $usuario->email = $request->email;
        $usuario->telf = $request->telf;
        $usuario->calle = $request->calle;
        $usuario->casa = $request->casa;
        $usuario->alicuota = $request->alicuota;;
        $usuario->email_verified_at = now();
        $usuario->password = $request->password;
        $usuario->remember_token = $request->remember_token;

        if ($request->rol == 1) {
            $usuario->removeRole('admin');
            $usuario->assignRole('comun');
        } elseif ($request->rol == 2) {
            $usuario->removeRole('comun');
            $usuario->assignRole('admin');
        }
        // $usuario->update($request->all()); Actualizacion masiva

        $usuario->save();



        return redirect()->route('usuarios.index');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->name <> auth()->user()->name) {

            $ctasxc = Ctasc::where('user_id', '=', $usuario->id)->get();

            $cuota = 0;
            $ncom = 0;
            $descrip = "";

            foreach ($ctasxc as $cuentas) {
                $cuota = $cuota + $cuentas->cuotap;
                $ncom = $ncom + $cuentas->nocomunes;

                $fact = Factura::where('id', '=', $cuentas->factura_id)->first();

                $peri = date('m-Y', strtotime( $fact->periodo));

                $descrip = $descrip . $peri . "/";
            }

            if ($descrip <> "") {

                $ctasin = new Ctasi();

                $ctasin->fecha = now()->format('Y-m-d');
                $ctasin->ci = $usuario->ci;
                $ctasin->name = $usuario->name;
                $ctasin->email = $usuario->email;
                $ctasin->telf = $usuario->telf;
                $ctasin->calle = $usuario->calle;
                $ctasin->casa = $usuario->casa;
                $ctasin->descripcion = $descrip;
                $ctasin->cuotap = $cuota;
                $ctasin->nocomunes = $ncom;

                $ctasin->save();
            }

            $usuario->delete();
            return redirect()->route('usuarios.index')->with('eliminar', 'ok');
        }

        return redirect()->route('usuarios.index', compact('usuario'))->with('info', 'mensaje enviado');
    }

    public function usuariosCXC(User $usuario)
    {
        $ctasc = Ctasc::where('user_id', '=', $usuario->id)
            ->where('restriccion', '=', 0)->get();
        $total = 0;

        $saldt = 0;
        $saldo = Saldo::where('user_id', '=', $usuario->id)->get();
        foreach ($saldo as $sald) {
            $saldt = $saldt + $sald->cargo - $sald->abono;
        }

        return view('usuarios.cxc', compact('usuario', 'ctasc', 'total', 'saldt'));
    }

    public function usuariosMOV(User $usuario)
    {
        $movimiento = Movimiento::truncate();
        $ctasc = Ctasc::where('user_id', '=', $usuario->id)->get();
        $pagos = Pago::where('user_id', '=', $usuario->id)->get();
        $saldos = Saldo::where('user_id', '=', $usuario->id)
            ->where('estatus', '=', NULL)->get();

        foreach ($saldos as $saldo) {
            $movimiento = new Movimiento();
            $movimiento->fecha = $saldo->fecha;
            $movimiento->descripcion = $saldo->descripcion;
            $movimiento->cargo = $saldo->cargo;
            $movimiento->abono = $saldo->abono;
            $movimiento->save();
        }

        foreach ($ctasc as $cuenta) {
            $factura = Factura::where('id', '=', $cuenta->factura_id)->first();
            $movimiento = new Movimiento();
            $movimiento->fecha = $factura->fecha;
            $movimiento->descripcion = "Periodo: " . $factura->periodo;
            $movimiento->cargo = $cuenta->cuotap + $cuenta->nocomunes;
            $movimiento->abono = 0;
            $movimiento->save();
        }
        foreach ($pagos as $pag) {
            $concilia = Ctasc::where('estatus', '=', $pag->num_operacion)->get();
            if (count($concilia) == 0) {
                $movimiento = new Movimiento();
                $movimiento->fecha = $pag->fecha;
                $movimiento->descripcion = $pag->operacion;
                $movimiento->cargo = 0;
                $movimiento->abono = $pag->monto;
                $movimiento->save();
            }
        }
        $movimiento = Movimiento::all()->sortBy('fecha');
        $total = 0;
        return view('usuarios.movis', compact('movimiento', 'total', 'usuario'));
    }


    public function usuariosRPEND(User $usuario)
    {
        $usuario = user::where('id', '=', auth()->user()->id)->first();

        $ctasc = Ctasc::where('user_id', '=', auth()->user()->id)->get();
        $saldt = 0;
        $cargo = 0;
        $estatus = NULL;
        $saldo = Saldo::where('user_id', '=', $usuario->id)->get();
        foreach ($saldo as $sald) {
            $saldt = $saldt + $sald->cargo - $sald->abono;
            if ($sald->cargo <> 0) {
                $cargo = $sald->cargo;
            }
            if ($sald->estatus <> NULL) {
                $estatus = $sald->estatus;
            }
        }

        $total = 0;

        return view('usuarios.rpend', compact('usuario', 'ctasc', 'total', 'saldt', 'saldo', 'cargo', 'estatus'));
    }

    public function usuariosRPENDADM(User $usuario)
    {
        $usuario = user::where('id', '=', $usuario->id)->first();

        $ctasc = Ctasc::where('user_id', '=', $usuario->id)->get();
        $saldt = 0;
        $cargo = 0;
        $estatus = NULL;
        $saldo = Saldo::where('user_id', '=', $usuario->id)->get();
        foreach ($saldo as $sald) {
            $saldt = $saldt + $sald->cargo - $sald->abono;
            if ($sald->cargo <> 0) {
                $cargo = $sald->cargo;
            }
            if ($sald->estatus <> NULL) {
                $estatus = $sald->estatus;
            }
        }

        $total = 0;

        return view('usuarios.rpendadm', compact('usuario', 'ctasc', 'total', 'saldt', 'saldo', 'cargo', 'estatus'));
    }


    public function usersPAGO(PagoStoreRequest $request)
    {
        $cadena = $request->idfac;
        $dividir = explode(",", $cadena); //convierte la cadera en array
        $pases =  count($dividir) - 1; //cuenta el numero de elementos en el array y lo asigna a la variable pases
        $x = 0;
        $nocomunes = 0;

        while ($x <= $pases - 1) {

            $factura = Factura::where('id', '=', $dividir[$x])->first();

            $periodo = $factura->periodo;

            $ctasc = Ctasc::where('factura_id', '=', $dividir[$x])->where('user_id', '=', auth()->user()->id)->first();

            $ctasc->estatus = $request->operacion;

            $ctasc->save();

            $x++;

            $nocomunes = $nocomunes +  $ctasc->nocomunes;
        }

        $pago = new Pago();

        $descripcion = $request->tipoperacion . " Ref. " . $request->operacion . " " . auth()->user()->name . " " . auth()->user()->calle . "-" . auth()->user()->casa;

        $pago->user_id = auth()->user()->id;
        $pago->operacion = $descripcion;
        $pago->fecha = $request->fecha;
        $pago->monto = $request->monto;
        $pago->montonc = $nocomunes;
        $pago->num_operacion = $request->operacion;
        $pago->ci_pagador = $request->ci;
        $pago->telf_pagador = $request->telf;
        $pago->restriccion = 0;
        $pago->slug = Str::slug("pago-" . auth()->user()->name, '-');


        $pago->save();

        /***************************************************************** */
        $usuario = user::where('id', '=', auth()->user()->id)->first();

        $ctasc = Ctasc::where('user_id', '=', auth()->user()->id)->get();

        $total = 0;

        return redirect()->route('usuarios-rpend', compact('usuario', 'ctasc', 'total'));
    }

    public function usuariosMOVIMIENTOS()
    {
        $movimiento = Movimiento::truncate();
        $ctasc = Ctasc::where('user_id', '=', auth()->user()->id)->get();
        $pagos = Pago::where('user_id', '=', auth()->user()->id)->get();
        $saldos = Saldo::where('user_id', '=', auth()->user()->id)
            ->where('estatus', '=', NULL)->get();

        foreach ($saldos as $saldo) {
            $movimiento = new Movimiento();
            $movimiento->fecha = $saldo->fecha;
            $movimiento->descripcion = $saldo->descripcion;
            $movimiento->cargo = $saldo->cargo;
            $movimiento->abono = $saldo->abono;
            $movimiento->save();
        }

        foreach ($ctasc as $cuenta) {
            $factura = Factura::where('id', '=', $cuenta->factura_id)->first();
            $movimiento = new Movimiento();
            $movimiento->fecha = $factura->fecha;
            $movimiento->descripcion = "Periodo: " . $factura->periodo;
            $movimiento->cargo = $cuenta->cuotap + $cuenta->nocomunes;
            $movimiento->abono = 0;
            $movimiento->save();
        }
        foreach ($pagos as $pag) {
            $concilia = Ctasc::where('estatus', '=', $pag->num_operacion)->get();
            if (count($concilia) == 0) {
                $movimiento = new Movimiento();
                $movimiento->fecha = $pag->fecha;
                $movimiento->descripcion = $pag->operacion;
                $movimiento->cargo = 0;
                $movimiento->abono = $pag->monto;
                $movimiento->save();
            }
        }
        $movimiento = Movimiento::all()->sortBy('fecha');
        $total = 0;
        return view('usuarios.mov', compact('movimiento', 'total'));
    }

    public function pdfEDOCTA()
    {
        $movimiento = Movimiento::truncate();
        $ctasc = Ctasc::where('user_id', '=', auth()->user()->id)->get();
        $pagos = Pago::where('user_id', '=', auth()->user()->id)->get();
        $saldos = Saldo::where('user_id', '=', auth()->user()->id)
            ->where('estatus', '=', NULL)->get();

        foreach ($saldos as $saldo) {
            $movimiento = new Movimiento();
            $movimiento->fecha = $saldo->fecha;
            $movimiento->descripcion = $saldo->descripcion;
            $movimiento->cargo = $saldo->cargo;
            $movimiento->abono = $saldo->abono;
            $movimiento->save();
        }

        foreach ($ctasc as $cuenta) {
            $factura = Factura::where('id', '=', $cuenta->factura_id)->first();
            $movimiento = new Movimiento();
            $movimiento->fecha = $factura->fecha;
            $movimiento->descripcion = "Periodo: " . $factura->periodo;
            $movimiento->cargo = $cuenta->cuotap + $cuenta->nocomunes;
            $movimiento->abono = 0;
            $movimiento->save();
        }
        foreach ($pagos as $pag) {
            $concilia = Ctasc::where('estatus', '=', $pag->num_operacion)->get();
            if (count($concilia) == 0) {
                $movimiento = new Movimiento();
                $movimiento->fecha = $pag->fecha;
                $movimiento->descripcion = $pag->operacion;
                $movimiento->cargo = 0;
                $movimiento->abono = $pag->monto;
                $movimiento->save();
            }
        }
        $movimiento = Movimiento::all()->sortBy('fecha');
        $total = 0;

        view()->share('usuarios.edoctapdf', $movimiento);
        $pdf = PDF::loadview('usuarios.edoctapdf', compact('movimiento', 'total'));
        return $pdf->stream('EdoCta.pdf');
    }

    public function pdfUEDOCTA(User $usuario)
    {

        $movimiento = Movimiento::truncate();
        $ctasc = Ctasc::where('user_id', '=', $usuario->id)->get();
        $pagos = Pago::where('user_id', '=', $usuario->id)->get();
        $saldos = Saldo::where('user_id', '=', $usuario->id)
            ->where('estatus', '=', NULL)->get();

        foreach ($saldos as $saldo) {
            $movimiento = new Movimiento();
            $movimiento->fecha = $saldo->fecha;
            $movimiento->descripcion = $saldo->descripcion;
            $movimiento->cargo = $saldo->cargo;
            $movimiento->abono = $saldo->abono;
            $movimiento->save();
        }

        foreach ($ctasc as $cuenta) {
            $factura = Factura::where('id', '=', $cuenta->factura_id)->first();
            $movimiento = new Movimiento();
            $movimiento->fecha = $factura->fecha;
            $movimiento->descripcion = "Periodo: " . $factura->periodo;
            $movimiento->cargo = $cuenta->cuotap + $cuenta->nocomunes;
            $movimiento->abono = 0;
            $movimiento->save();
        }
        foreach ($pagos as $pag) {
            $concilia = Ctasc::where('estatus', '=', $pag->num_operacion)->get();
            if (count($concilia) == 0) {
                $movimiento = new Movimiento();
                $movimiento->fecha = $pag->fecha;
                $movimiento->descripcion = $pag->operacion;
                $movimiento->cargo = 0;
                $movimiento->abono = $pag->monto;
                $movimiento->save();
            }
        }
        $movimiento = Movimiento::all()->sortBy('fecha');
        $total = 0;

        view()->share('usuarios.edoctaupdf', $movimiento);
        $pdf = PDF::loadview('usuarios.edoctaupdf', compact('movimiento', 'total', 'usuario'));
        return $pdf->stream('EdoCtau.pdf');
    }

    public function usuariosDEUDAFORM(User $usuario)
    {
        $usuario = User::where('id', '=', auth()->user()->id)->first();
        $saldt = 0;
        $saldo = Saldo::where('user_id', '=', auth()->user()->id)->get();
        foreach ($saldo as $sald) {
            $saldt = $saldt + $sald->cargo - $sald->abono;
        }

        $total = 0;

        return view('saldos.psald', compact('usuario', 'total', 'saldt'));
    }

    public function usersDEUDA(PagoStoreRequest $request)
    {

        $saldo = new Saldo();
        $descripcion =  "Pago D.A.: " . $request->tipoperacion . " Ref. " . $request->operacion . " " . auth()->user()->name . " " . auth()->user()->calle . "-" . auth()->user()->casa . "-" . $request->ci . "-" . $request->telf;
        $saldo->user_id = auth()->user()->id;
        $saldo->fecha = $request->fecha;
        $saldo->descripcion = $descripcion;
        $saldo->cargo = 0;
        $saldo->abono = $request->monto;
        $saldo->estatus = $request->operacion;
        $saldo->save();

        $usuario = user::where('id', '=', auth()->user()->id)->first();

        $ctasc = Ctasc::where('user_id', '=', auth()->user()->id)->get();

        $total = 0;

        return redirect()->route('usuarios-rpend', compact('usuario', 'ctasc', 'total'));
    }
}
