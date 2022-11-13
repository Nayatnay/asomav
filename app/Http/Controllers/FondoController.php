<?php

namespace App\Http\Controllers;

use App\Http\Requests\FondoStoreRequest;
use App\Http\Requests\FondoUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Fondo;
use Illuminate\Support\Facades\DB;
use App\Models\Gasto;
use App\Models\Reserva;
use App\Models\Saldo;
use App\Models\Temp;
use App\Models\Ctasc;
use App\Models\Tempsaldo;
use App\Models\User;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class FondoController extends Controller
{
    public function __construct()
    {
        $this->Middleware('can:fondos.index')->only('index'); //protege todas las rutas de facturas
        $this->Middleware('can:fondos.create')->only('create', 'store');
        $this->Middleware('can:fondos.edit')->only('edit', 'update');
        $this->Middleware('can:fondos.destroy')->only('destroy');
        $this->Middleware('can:fondos-egresos')->only('fondosEGRESOS');
        $this->Middleware('can:fondos-reservas')->only('reservas');
        $this->Middleware('can:fondos-reservas-create')->only('reservasCREATE');
        $this->Middleware('can:fondos-pagos')->only('fondosPAGOS');
        $this->Middleware('can:fondos-pagos-cxp')->only('fondosPAGOSCXP');
    }

    /********************************************************************/
    public function index(request $request)
    {
        $buscar = $request->buscar;
        $fondos = Fondo::all()->sortBy('fecha');
        $total = 0;
        foreach ($fondos as $fondo) {
            $total = $total + $fondo->cargo - $fondo->abono;
        }

        $reservas = Reserva::all()->sortBy('fecha');
        $totalr = 0;
        foreach ($reservas as $reserva) {
            $totalr = $totalr + $reserva->cargo - $reserva->abono;
        }

        $fondos = Fondo::where('fecha', 'LIKE', '%' . $buscar . '%')
            ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
            ->orwhere('cargo', 'LIKE', '%' . $buscar . '%')
            ->orwhere('abono', 'LIKE', '%' . $buscar . '%')
            ->orwhere('restriccion', 'LIKE', '%' . $buscar . '%')
            ->get()->sortBy(['fecha']);

        return view('fondos.index', compact('fondos', 'buscar', 'total', 'totalr'));
    }

    /********************************************************************/
    public function create()
    {
        return view('fondos.add');
    }


    /********************************************************************/
    public function fondosEGRESOS()
    {
        $gastos = Gasto::where('id', '<>', 1)->get()->sortBy('id');
        return view('fondos.addegreso', compact('gastos'));
    }

    /********************************************************************/
    public function reservas()
    {
        return view('fondos.addreservas');
    }


    /********************************************************************/
    public function reservasCREATE(request $request)
    {
        $reservas = new Reserva();

        $reservas->fecha = $request->fecha;

        if ($request->tipofondo == "cargo") {
            $reservas->cargo = $request->monto;
            $reservas->abono = 0;
            $ctrl = 1;
        } else {
            $reservas->cargo = 0;
            $reservas->abono = $request->monto;
            $ctrl = 0;
        }

        $reservas->save();

        if ($ctrl == 1) {

            $fondos = new Fondo();
            $fondos->fecha = $request->fecha;
            $fondos->descripcion = "Cargo a Fondo de Reserva";
            $fondos->slug = Str::slug('cargo-fondo-reserva ' . $request->fecha, '-');
            $fondos->cargo = 0;
            $fondos->abono = $reservas->cargo;
            $fondos->cod_id = 1;
            $fondos->restriccion = 0;
            $fondos->save();
        } else {

            $fondos = new Fondo();
            $fondos->fecha = $request->fecha;
            $fondos->descripcion = "Abono del Fondo de Reserva";
            $fondos->slug = Str::slug('abono-fondo-reserva ' . $request->fecha, '-');
            $fondos->cargo = $reservas->abono;
            $fondos->abono = 0;
            $fondos->cod_id = 1;
            $fondos->restriccion = 0;
            $fondos->save();
        }

        return redirect()->route('fondos.index');
    }

    /********************************************************************/
    public function store(FondoStoreRequest $request)
    {
        $fondos = new Fondo();

        $fondos->fecha = $request->fecha;
        $fondos->descripcion = $request->descripcion;
        $fondos->slug = Str::slug($request->descripcion, '-');

        if ($request->tipofondo == "ingreso") {
            $fondos->cargo = $request->monto;
            $fondos->abono = 0;
            $fondos->cod_id = $request->cod_id;
        } else {
            $fondos->cargo = 0;
            $fondos->abono = $request->monto;
            if ($request->gastoid == "Seleccione Servicio o Proveedor") {
                $fondos->cod_id = 0;
            } else {
                $fondos->cod_id = $request->gastoid;
            }
        }

        $fondos->restriccion = 0;
        $fondos->save();

        return redirect()->route('fondos.index');
    }

    public function fondosPAGOSCXP(FondoStoreRequest $request)
    {
        $fondos = new Fondo();

        $fondos->fecha = $request->fecha;
        $fondos->cod_id = $request->idgasto;
        $fondos->descripcion = "Pago CxP " . $request->descripcion;
        $fondos->slug = Str::slug("pago-cxp" . $request->descripcion, '-');
        $fondos->cargo = 0;
        $fondos->abono = $request->monto;
        $fondos->restriccion = 0;

        $fondos->save();

        return redirect()->route('fondos.index');
    }



    /********************************************************************/
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

    /********************************************************************/

    public function edit(Fondo $fondo)
    {
        if ($fondo->restriccion <> 1) {
            // Verificar si  el registro a editar corresponde a un monto de reserva
            if ($fondo->descripcion == "Cargo a Fondo de Reserva" || $fondo->descripcion == "Abono del Fondo de Reserva") {
                return redirect()->route('fondos.index')->with('info', 'mensaje enviado');
            }
            return view('fondos.edit', compact('fondo'));
        }
        return redirect()->route('fondos.index')->with('info', 'mensaje enviado');
    }

    /********************************************************************/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function update(FondoUpdateRequest $request, Fondo $fondo)
    {
        $fondo->fecha = $request->fecha;
        $fondo->descripcion = $request->descripcion;
        $fondo->slug = Str::slug($request->descripcion, '-');

        if ($request->tipofondo == "cargo") {
            $fondo->cargo = $request->monto;
            $fondo->abono = 0;
        } else {
            $fondo->cargo = 0;
            $fondo->abono = $request->monto;
        }
        $fondo->restriccion = $request->restriccion;

        $fondo->save();
        $total = 0;

        return redirect()->route('fondos.index');
    }

    /********************************************************************/
    /* * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fondo $fondo)
    {
        if ($fondo->restriccion <> 1) {
            // Verificar si  el registro a eliminar corrsponde a un monto de reserva
            if ($fondo->descripcion == "Cargo a Fondo de Reserva" || $fondo->descripcion == "Abono del Fondo de Reserva") {
                $reserva = Reserva::where('fecha', '=', $fondo->fecha)
                    ->where('cargo', '=', $fondo->abono)
                    ->where('abono', '=', $fondo->cargo)->first();
                $reserva->delete();
            }
            /************************************************************************/
            $fondo->delete();
            return redirect()->route('fondos.index')->with('eliminar', 'ok');
        }
        return redirect()->route('fondos.index', compact('fondo'))->with('info', 'mensaje enviado');
    }

    public function fondosFINANZAS()
    {
        $total = 0;
        $totalg = 0;

        $fondos = Fondo::all()->sortBy('fecha');

        foreach ($fondos as $fondo) {
            $total = $total + $fondo->cargo - $fondo->abono;
        }

        $reservas = Reserva::all()->sortBy('fecha');
        $totalr = 0;
        foreach ($reservas as $reserva) {
            $totalr = $totalr + $reserva->cargo - $reserva->abono;
        }
           
        $fondos = Fondo::where('abono', '<>', 0)->get()->sortBy('fecha');

        $ctasc = Ctasc::where('restriccion', '=', 0)->get()->sortBy(['user_id', 'factura_id']);
       
        //$conteo = DB::select('select user_id from saldos group by user_id having count(*)=1'); //obtiene solo los registros cuyo user_id no se repite

        $conteo = Saldo::where('cargo', '<>', 0)->get();

        $saldo = Tempsaldo::truncate();

        foreach ($conteo as $deuda) {

            $saldo = Saldo::where('user_id', '=', $deuda->user_id)
                ->where('abono', '<>', 0)->first();

            if ($saldo == NULL) {
                $tsald = new Tempsaldo();
                $tsald->user_id = $deuda->user_id;
                $tsald->deuda = $deuda->cargo;
                $tsald->save();
            } elseif ($saldo->estatus <> NULL) {
                $tsald = new Tempsaldo();
                $tsald->user_id = $deuda->user_id;
                $tsald->deuda = $saldo->abono;
                $tsald->save();
            }
        }

        $saldo = Tempsaldo::all();

        $totald = 0;
        $totalg = 0;

        return view('fondos.fmoro', compact('total', 'totald', 'totalg', 'fondos', 'ctasc', 'totalr', 'saldo'));
    }

    public function fondosPAGOS(Temp $temp)
    {

        $gastos = Gasto::where('descripcion', '=', strtolower($temp->servicio))->first();

        return view('fondos.pagocxp', compact('temp', 'gastos'));
    }


    public function pdfGASTOSMES()
    {
        $fondos = Fondo::where('abono', '<>', 0)->get()->sortBy('fecha');
       $total = 0;
       
        view()->share('fondos.gastospdf', $fondos);
        $pdf = PDF::loadview('fondos.gastospdf', compact('fondos', 'total'));
        return $pdf->stream('gastos.pdf');
    }

    public function pdfMOROSOS()
    {
        $ctasc = Ctasc::where('restriccion', '=', 0)->get()->sortBy(['user_id', 'factura_id']);
        $total = 0;
        $totalg = 0;
       
        view()->share('fondos.morosospdf', $ctasc);
        $pdf = PDF::loadview('fondos.morosospdf', compact('ctasc', 'total', 'totalg'));
        return $pdf->stream('morosos.pdf');
    }

    public function pdfDEUDANTE()
    {
        $conteo = Saldo::where('cargo', '<>', 0)->get();

        $saldo = Tempsaldo::truncate();

        foreach ($conteo as $deuda) {

            $saldo = Saldo::where('user_id', '=', $deuda->user_id)
                ->where('abono', '<>', 0)->first();

            if ($saldo == NULL) {
                $tsald = new Tempsaldo();
                $tsald->user_id = $deuda->user_id;
                $tsald->deuda = $deuda->cargo;
                $tsald->save();
            } elseif ($saldo->estatus <> NULL) {
                $tsald = new Tempsaldo();
                $tsald->user_id = $deuda->user_id;
                $tsald->deuda = $saldo->abono;
                $tsald->save();
            }
        }

        $saldo = Tempsaldo::all();
        $total = 0;
        $totalg = 0;
       
        view()->share('fondos.deudantepdf', $saldo);
        $pdf = PDF::loadview('fondos.deudantepdf', compact('saldo', 'total', 'totalg'));
        return $pdf->stream('deuda.pdf');
    }

    public function pdfONDOS(request $request)
    {
        
        $fondos = Fondo::all()->sortBy('fecha');
        $total = 0;

        view()->share('fondos.fondospdf', $fondos);
        $pdf = PDF::loadview('fondos.fondospdf', compact('fondos', 'total'));
        return $pdf->stream('fondos.pdf');
        
    }



}
