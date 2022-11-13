<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\User;
use App\Models\Ctasc;
use App\Models\Fondo;
use App\Models\Reserva;
use App\Models\Saldo;
use App\Models\Tpag;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->Middleware('can:ver-conciliar-pagos')->only('verconciliarPAGOS');
        $this->Middleware('can:conciliar-pagos')->only('conciliarPAGOS');
        $this->Middleware('can:conciliar-deuda')->only('conciliarDEUDA');
    }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    public function verconciliarPAGOS()
    {
        $pagos = Pago::where('restriccion', '=', 0)->get();
        $saldos = Saldo::where('estatus', "<>", NULL)->get();

        return view('conciliaciones.index', compact('pagos', 'saldos'));
    }

    public function conciliarPAGOS(Pago $pago)
    {

        $pago->restriccion = 1;
        $pago->save();

        $ctasc = Ctasc::where('estatus', '=', $pago->num_operacion)->get();

        foreach ($ctasc as $cta) {
            $cta->restriccion = 1;
            $cta->estatus = "Pagado";
            $cta->save();
        }


        //Calculo del 10% de reserva tomado del pago general
        $pagmonres = $pago->monto - $pago->montonc;
        $totreserva = $pagmonres - ($pagmonres / 1.10);

        //Calculo de pago que va a los fondos excluyendo el monto que se asigna como reserva de fondo

        $totfondo = $pago->monto - $totreserva;

        $fondos = new Fondo();
        $fondos->fecha = $pago->fecha;
        $fondos->descripcion = $pago->operacion;
        $fondos->slug = Str::slug($pago->operacion, '-');
        $fondos->cargo = $totfondo;
        $fondos->abono = 0;
        $fondos->cod_id = 0;
        $fondos->restriccion = 1;

        $fondos->save();


        $reserva = new Reserva();

        $reserva->fecha = $pago->fecha;
        $reserva->cargo = $totreserva;
        $reserva->abono = 0;

        $reserva->save();

        return redirect()->route('ver-conciliar-pagos');
    }

    public function conciliarDEUDA(Saldo $saldo)
    {
        $fondos = new Fondo();
        $fondos->fecha = $saldo->fecha;
        $fondos->descripcion = $saldo->descripcion;
        $fondos->slug = Str::slug($saldo->descripcion, '-');
        $fondos->cargo = $saldo->abono;
        $fondos->abono = 0;
        $fondos->cod_id = 0;
        $fondos->restriccion = 1;

        $fondos->save();

        $saldo->estatus = NULL;
        $saldo->save();

        return redirect()->route('ver-conciliar-pagos');
    }
}
