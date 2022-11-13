<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;
use App\Http\Requests\ComunicadoStoreRequest;
use App\Http\Requests\ComunicadoUpdateRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ComunicadoController extends Controller
{
    
    public function __construct()
    {
        //$this->Middleware('can:comunicados.index');//protege todas las rutas de comunicados

        $this->Middleware('can:comunicados.index')->only('index');  
        $this->Middleware('can:comunicados.create')->only('create', 'store');
        $this->Middleware('can:comunicados.edit')->only('edit', 'update');
        $this->Middleware('can:comunicados.destroy')->only('destroy');
    }

    public function index(request $request)
    {
        $buscar = $request->buscar;

        $comunicados = Comunicado::where('fecha', 'LIKE', '%' . $buscar . '%')
            ->orwhere('encabezado', 'LIKE', '%' . $buscar . '%')
            ->orwhere('cuerpo', 'LIKE', '%' . $buscar . '%')
            ->get()->sortBy('fecha');

        return view('comunicados.index', compact('comunicados', 'buscar'));

    }

    public function create()
    {
        return view('comunicados.add');
    }

    public function store(ComunicadoStoreRequest $request)
    {
        $comunicado = new Comunicado();
        
        $slug = "comunicado" . "-" . $request->fecha . "-" . $request->fecha;

        $comunicado->fecha = $request->fecha;
        $comunicado->slug = Str::slug($slug, '-');
        $comunicado->encabezado = $request->encabezado;
        $comunicado->cuerpo = $request->cuerpo;

        $comunicado->save();

        $slug = "comunicado" . "-" . $comunicado->id . "-" . $request->fecha;
        $comunicado->slug = Str::slug($slug, '-');
        $comunicado->save();

        return redirect()->route('comunicados.index');
    }

    public function edit(Comunicado $comunicado)
    {
        return view('comunicados.edit', compact('comunicado'));
    }

    public function update(ComunicadoUpdateRequest $request, Comunicado $comunicado)
    {
        $slug = "comunicado" . "-" . $comunicado->id . "-" . $request->fecha;
        
        
        $comunicado->fecha = $request->fecha;
        $comunicado->slug = Str::slug($slug, '-');
        $comunicado->encabezado = $request->encabezado;
        $comunicado->cuerpo = $request->cuerpo;

        $comunicado->save();
        return redirect()->route('comunicados.index');
    }

    public function destroy(Comunicado $comunicado)
    {
        $comunicado->delete();
        return redirect()->route('comunicados.index');
    }

    public function createPDF(Comunicado $comunicado)
    {      
        view()->share('comunicados.comunicado', $comunicado);
        $pdf = PDF::loadview('comunicados.comunicado', compact('comunicado'));
        return $pdf->setPaper(array(0,0,612.00,792.00), 'portrait')->stream('comunicado.pdf');
    }

    public function showpdf()    
    {
        //$comunicados = Comunicado::latest()->first();  devuelve el ultimo registro de una coleccion
        $comunicados = Comunicado::orderByDesc('id')->Paginate(4);//ordena por fecha de forma descendente   
        return view('comunicados.show', compact('comunicados'));
    }
}
