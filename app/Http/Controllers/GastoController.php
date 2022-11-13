<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Fdetalle;
use App\Models\Fondo;
use App\Models\Temp;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GastoStoreRequest;
use App\Http\Requests\GastoUpdateRequest;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class GastoController extends Controller
{

    public function __construct()
    {
        $this->Middleware('can:gastos.index');  //protege todas las rutas de gastos
        $this->Middleware('can:gastos-proveedores')->only('gastosPROVEE');
    }

    public function index(Request $request)

    {
        $buscar = $request->buscar;

        $gastos = Gasto::where('id', '<>', 1)
            ->where('descripcion', 'LIKE', '%' . $buscar . '%')
            ->get()->sortBy('descripcion');

        return view('gastos.index', compact('gastos', 'buscar'));
    }

    public function create()

    {
        return view('gastos.add');
    }

    public function store(GastoStoreRequest $request)

    {
        $gasto = new Gasto();

        $gasto->descripcion = $request->descripcion;
        $gasto->slug = Str::slug($request->descripcion, '-');

        $gasto->save();
        return redirect()->route('gastos.index');
    }

    public function edit(Gasto $gasto)

    {
        $gas = $gasto->id;
        $consulgas = Fdetalle::where('gasto_id', '=', $gas)->get();
        if (count($consulgas) == 0) {
            return view('gastos.edit', compact('gasto'));
        }
        return redirect()->route('gastos.index')->with('editar', 'no');
    }

    public function show($id)

    {
        //
    }

    public function update(GastoUpdateRequest $request, Gasto $gasto)
    {
        $gasto->descripcion = $request->descripcion;
        $gasto->slug = Str::slug($request->descripcion, '-');

        $gasto->save();
        return redirect()->route('gastos.index');
    }

    public function destroy(Gasto $gasto)

    {
        $gas = $gasto->id;
        $consulgas = Fdetalle::where('gasto_id', '=', $gas)->get();
        if (count($consulgas) == 0) {
            $gasto->delete();
            return redirect()->route('gastos.index')->with('eliminar', 'ok');
        } else {
            return redirect()->route('gastos.index')->with('eliminar', 'no');
        }
    }

    public function gastosPROVEE(request $request)
    {

        $temp = Temp::truncate();

        $fondos = Fondo::all()->sortBy('fecha');
        $totalf = 0;
        foreach ($fondos as $fondo) {
            $totalf = $totalf + $fondo->cargo - $fondo->abono;
        }

        $reservas = Reserva::all()->sortBy('fecha');
        $totalr = 0;
        foreach ($reservas as $reserva) {
            $totalr = $totalr + $reserva->cargo - $reserva->abono;
        }

        $gastos = Gasto::where('id', '<>', 1)->get()->sortBy('id');

        foreach ($gastos as $gasto) {

            $facturado = 0;
            $pagado = 0;

            $fdetalles = Fdetalle::where('gasto_id', '=', $gasto->id)->get();
            foreach ($fdetalles as $fdetalle) {
                $facturado += $fdetalle->monto;
            }
            $fondos = Fondo::where('cod_id', '=', $gasto->id)->get();
            foreach ($fondos as $fondo) {
                $pagado += $fondo->abono;
            }

            $temp = new Temp();
            $temp->servicio = $gasto->descripcion;
            $temp->facturado = $facturado;
            $temp->pagado = $pagado;
            $temp->save();
        }

        $temps = Temp::all();
        $total = 0;
        $totalg = 0;

        return view('fondos.cxp', compact('temps', 'total', 'totalg', 'totalf', 'totalr'));
    }

    public function cxpPDF(request $request)
    {

        $temp = Temp::truncate();

        $fondos = Fondo::all()->sortBy('fecha');
        $totalf = 0;
        foreach ($fondos as $fondo) {
            $totalf = $totalf + $fondo->cargo - $fondo->abono;
        }

        $reservas = Reserva::all()->sortBy('fecha');
        $totalr = 0;
        foreach ($reservas as $reserva) {
            $totalr = $totalr + $reserva->cargo - $reserva->abono;
        }

        $gastos = Gasto::where('id', '<>', 1)->get()->sortBy('id');

        foreach ($gastos as $gasto) {

            $facturado = 0;
            $pagado = 0;

            $fdetalles = Fdetalle::where('gasto_id', '=', $gasto->id)->get();
            foreach ($fdetalles as $fdetalle) {
                $facturado += $fdetalle->monto;
            }
            $fondos = Fondo::where('cod_id', '=', $gasto->id)->get();
            foreach ($fondos as $fondo) {
                $pagado += $fondo->abono;
            }

            $temp = new Temp();
            $temp->servicio = $gasto->descripcion;
            $temp->facturado = $facturado;
            $temp->pagado = $pagado;
            $temp->save();
        }

        $temps = Temp::all();
        $total = 0;
        $totalg = 0;

        view()->share('fondos.cxppdf', $temps);
        $pdf = PDF::loadview('fondos.cxppdf', compact('temps', 'total', 'totalg'));
        return $pdf->stream('cxp.pdf');

    }

    public function ctaPROVEEDOR(Request $request)
    {

        $gastos = Gasto::where('id', '<>', 1)->get()->sortBy('id');

        $buscar = $request->buscar;
        $gast = $request->servicios;

        $fdetalles = Fdetalle::where('gasto_id', '=', $gast)->get();
        
        if ($gast == 0) {
           $fondos = [];
        } else {
            $fondos = Fondo::where('cod_id', '=', $gast)->get();
        }
        
        $total = 0;
        $totalf = 0;
        $totalb = 0;
        $totalg = 0;

        return view('gastos.ctaprov', compact('gastos', 'buscar', 'fdetalles', 'fondos', 'total', 'totalf', 'totalb'));
    }
}
