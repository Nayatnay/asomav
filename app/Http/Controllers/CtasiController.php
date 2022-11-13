<?php

namespace App\Http\Controllers;

use App\Models\Ctasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CtasiController extends Controller
{
    public function index()

    {
        $ctasincob = Ctasi::all()->sortBy('fecha');
        $total = 0;
        $totalg = 0;
        return view('ctasincob.index', compact('ctasincob', 'total', 'totalg'));
    }

    
    public function ctasincPDF()

    {
        $ctasincob = Ctasi::all()->sortBy('fecha');
        $total = 0;
        $totalg = 0;

        view()->share('ctasincob.ctasincpdf', $ctasincob);
        $pdf = PDF::loadview('ctasincob.ctasincpdf', compact('ctasincob', 'total', 'totalg'));
        return $pdf->stream('Cuentas Incobrables.pdf');
    }



}
