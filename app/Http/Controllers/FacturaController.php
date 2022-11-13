<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Gasto;
use App\Models\User;
use App\Models\Fdetalle;
use App\Models\Gnoc;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Http\Requests\FacturaStoreRequest;
use App\Models\Ctasc;
use phpDocumentor\Reflection\Types\Nullable;

class FacturaController extends Controller
{
    //**************************************** */
    public function __construct()
    {
        $this->Middleware('can:facturas.index')->only('index'); //protege todas las rutas de facturas
        $this->Middleware('can:facturas.create')->only('create', 'store');
        $this->Middleware('can:facturas.edit')->only('edit', 'update');
        $this->Middleware('can:facturas.show')->only('show');
        $this->Middleware('can:facturas.destroy')->only('destroy');
        $this->Middleware('can:facturas.detallesFACTURA')->only('detallesFACTURA');
        $this->Middleware('can:facturas.verCTASXC')->only('verCTASXC');
    }
    //************  MODULO INDEX DE FACTURACION ***************** */

    public function index(request $request)
    {
        $buscar = $request->buscar;

        $facturas = Factura::where('fecha', 'LIKE', '%' . $buscar . '%')
            ->orwhere('periodo', 'LIKE', '%' . $buscar . '%')
            ->get()->sortBy('periodo');

        return view('facturas.index', compact('facturas', 'buscar'));
    }

    //**************************************** */
    public function create()
    {
        return view('facturas.add');
    }

    //**************************************** */
    public function store(FacturaStoreRequest $request)
    {
        $peri = $request->periodo;

        $periodo = Factura::where('periodo', '=', $peri)->get();

        if (count($periodo) == 0) {

            $factura = new Factura();

            $factura->fecha = $request->fecha;
            $factura->periodo = $request->periodo;
            $factura->slug = Str::slug("Factura-" . $factura->periodo);
            $factura->tasa = $request->tasa;

            $factura->save();

            return redirect()->route('detalles-factura', compact('factura'));
        }

        return redirect()->route('facturas.create')->with('info', 'mensaje enviado');
    }

    //**************************************** */
    public function destroy(Factura $factura)
    {
        $ctasc = Ctasc::where('factura_id', '=', $factura->id)->get();

        if (count($ctasc) == 0) {
            $factura->delete();
            return redirect()->route('facturas.index')->with('eliminar', 'ok');
        }
        return redirect()->route('facturas.index', compact('factura'))->with('eliminar', 'no');
    }


    // ************************Ruta de modulo de ADICION de detalles de factura**********

    public function detallesFACTURA(Factura $factura)
    {
        $ctasc = Ctasc::where('factura_id', '=', $factura->id)->get();

        if (count($ctasc) == 0) {

            $gastos = Gasto::where('id', '<>', 1)->get()->sortBy('descripcion');
            $users = User::all();
            $fdetalles = Fdetalle::where('factura_id', '=', $factura->id)->get();
            $gnoc = Gnoc::where('factura_id', '=', $factura->id)->get();

            return view('facturas.addet', compact('factura', 'gastos', 'fdetalles', 'users', 'gnoc'));
        }
        return redirect()->route('facturas.index', compact('factura'))->with('info', 'mensaje enviado');
    }

    //**************************************** */

    public function validarGASTO(Request $request, Gasto $gastos, Factura $factura)
    {
        if ($request->monto == "") {
            $monto = 0;
        } else {
            $monto = $request->monto;
        }

        $Fdetalle = new Fdetalle();

        $Fdetalle->factura_id = $request->idfactura;
        $Fdetalle->gasto_id = $request->gastos;
        $Fdetalle->monto = $monto;

        $Fdetalle->save();

        return redirect()->route('detalles-factura', compact('factura'));
    }

    //**************************************** */
    public function validarGASTONC(Request $request, Gasto $gastos, Factura $factura)
    {

        if ($request->monto == "") {
            $monto = 0;
        } else {
            $monto = $request->monto;
        }

        if ($request->descripcion == "") {
            $descripcion = "N/A";
            $monto = 0;
        } else {
            $descripcion = $request->descripcion;
        }

        $gnoc = new Gnoc();

        $gnoc->factura_id = $request->idfactura;
        $gnoc->user_id = $request->user_id;
        $gnoc->descripcion = $descripcion;
        $gnoc->monto = $monto;

        $gnoc->save();

        return redirect()->route('detalles-factura', compact('factura'));
    }

    //**************************************** */
    public function destroyDETALLE(Request $request, Fdetalle $fdetalle)
    {
        $num = $request->idfactura;
        $factura = Factura::where('id', '=', $num)->first();
        $fdetalle->delete();

        return redirect()->route('detalles-factura', compact('factura'));
    }

    //**************************************** */
    public function destroyDETALLENC(Request $request, Gnoc $gnoc)
    {
        $num = $request->idfactura;
        $factura = Factura::where('id', '=', $num)->first();
        $gnoc->delete();

        return redirect()->route('detalles-factura', compact('factura'));
    }

    //******************** MUESTRA EL RECIBO CDM ******************** */

    public function show(Factura $factura)
    {

        $gastos = Gasto::all()->sortBy('descripcion'); //return $gastos;
        $numusers = user::count();
        $alicuota = number_format(100 / $numusers, 2, ".", ",");
        $montoreser = 0;
        $users = User::all();
        $fdetalles = Fdetalle::where('factura_id', '=', $factura->id)->get();

        foreach ($fdetalles as $fdetalle) {
            $montoreser += $fdetalle->monto;
        }

        $montoreser = $montoreser * 0.1;

        $gnoc = Gnoc::where('factura_id', '=', $factura->id)->get();

        $total = 0;
        $totalgeneral = 0;
        $totaldivisa = 0;
        $cuotaparte = 0;
        $cuotapartereserv = 0;
        $totcuotap = 0;


        return view('facturas.recibocdm', compact('factura', 'gastos', 'fdetalles', 'total', 'cuotaparte', 'cuotapartereserv', 'totcuotap', 'totalgeneral', 'totaldivisa', 'alicuota', 'montoreser', 'users', 'gnoc'));
    }

    //**************************************** */
    public function cerrarFACTURA(Factura $factura)
    {
        $ctasc = Ctasc::where('factura_id', '=', $factura->id)->get();

        if (count($ctasc) == 0) {

            $tot = 0;
            $numusers = user::count();
            $alicuota = number_format(100 / $numusers, 2, ".", ",");
            $users = User::all();

            $fdetalles = Fdetalle::where('factura_id', '=', $factura->id)->get();

            foreach ($fdetalles as $fdetalle) {
                $tot += $fdetalle->monto;
            }

            $montoreser = $tot * 0.1;

            $totaldiv = ($tot + $montoreser) * ($alicuota / 100);

            //agregar detalle de fondo de reserva para esta factura

            $Fdetalle = new Fdetalle();

            $Fdetalle->factura_id = $factura->id;
            $Fdetalle->gasto_id = 1;
            $Fdetalle->monto = $montoreser;

            $Fdetalle->save();

            $fdetalles = Fdetalle::where('factura_id', '=', $factura->id)->get();

            foreach ($users as $propietario) {

                $id = $propietario->id;
                $monto = 0;
                $gnocs = Gnoc::where('factura_id', '=', $factura->id)->where('user_id', '=', $id)->get();

                foreach ($gnocs as $nocomun) {
                    $monto += $nocomun->monto;
                }

                $ctasc = new Ctasc();
                $ctasc->factura_id = $factura->id;
                $ctasc->user_id = $propietario->id;
                $ctasc->slug = Str::slug("cxc-propietario" . $propietario->id);
                $ctasc->cuotap = $totaldiv;
                $ctasc->nocomunes = $monto;
                $ctasc->alicuota = $alicuota;
                $ctasc->restriccion = 0;
                $ctasc->save();
            }

            $total = 0;
            $totalg = 0;
            $ctasc = Ctasc::where('factura_id', '=', $factura->id)->get();

            return view('facturas.ctasc', compact('ctasc', 'factura', 'users', 'total', 'totalg'));
        }

        return redirect()->route('facturas.show', compact('factura'))->with('info', 'mensaje enviado');
    }

    //*************** VER RECIBOS DE CTAS X COBRAR */

    public function verCTASXC()
    {
        $ctasc = Ctasc::where('restriccion', '=', 0)->get();
        $totalg = 0;
        return view('facturas.ctasc', compact('ctasc', 'totalg'));
    }

    public function createPDFRECPEN(Ctasc $ctasc)
    {
        $ctasc = Ctasc::where('restriccion', '=', 0)->get();
        $totalg = 0;
        if (count($ctasc) == 0) {
            return redirect()->route('ver-ctasxc');
        }

        view()->share('facturas.recpenpdf', $ctasc);
        $pdf = PDF::loadview('facturas.recpenpdf', compact('ctasc', 'totalg'));
        return $pdf->setPaper(array(0, 0, 612.00, 792.00), 'portrait')->stream('Listado RecPend.pdf');
    }

    public function verRECOBRO($cuentas)
    {


        $ctasc = Ctasc::where('id', '=', $cuentas)->first();

        $users = User::where('id', '=', $ctasc->user_id)->first();
        $factura = Factura::where('id', '=', $ctasc->factura_id)->first();
        $fdetalles = Fdetalle::where('factura_id', '=', $ctasc->factura_id)->get();
        $gnoc = Gnoc::where('factura_id', '=', $ctasc->factura_id)->where('user_id', '=', $users->id)->get();

        $gastos = Gasto::all();

        $total = 0;
        $totalgeneral = 0;
        $totaldivisa = 0;
        $cuotaparte = 0;
        $totcuotap = 0;


        return view('facturas.recobro', compact('ctasc', 'users', 'fdetalles', 'gnoc', 'factura', 'gastos', 'total', 'cuotaparte', 'totcuotap', 'totalgeneral', 'totaldivisa'));
    }

    public function createPDFRECOBRO(Ctasc $ctasc)
    {

        $users = User::where('id', '=', $ctasc->user_id)->first();
        $fdetalles = Fdetalle::where('factura_id', '=', $ctasc->factura_id)->get();
        $gnoc = Gnoc::where('factura_id', '=', $ctasc->factura_id)->where('user_id', '=', $users->id)->get();
        $factura = Factura::where('id', '=', $ctasc->factura_id)->first();
        $gastos = Gasto::all();

        $total = 0;
        $totalgeneral = 0;
        $totaldivisa = 0;
        $cuotaparte = 0;
        $totcuotap = 0;

        view()->share('facturas.recobropdf', $ctasc);
        $pdf = PDF::loadview('facturas.recobropdf', compact('ctasc', 'users', 'fdetalles', 'gnoc', 'factura', 'gastos', 'total', 'cuotaparte', 'totcuotap', 'totalgeneral', 'totaldivisa'));
        return $pdf->stream('Listado ReCobro.pdf');
    }
}
