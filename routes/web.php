<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpalController;
use App\Http\Controllers\BuzonController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FondoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\CtasiController;


use App\Http\Controllers\ConfigController;
use App\Mail\BuzonMailable;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*************************** */

Route::get('ppal', [PpalController::class, 'index'])->name('index');

/*************************** */

Route::resource('buzon', BuzonController::class)->names('buzon');
Route::get('envios', [BuzonController::class, 'enviosMASIVOS'])->name('envios');

/**************************** */

Route::resource('perfil', PerfilController::class)->names('perfil');

/******************************* */

Route::resource('usuarios', UsuarioController::class)->names('usuarios');
Route::get('usuarios-cxc/{usuario}', [UsuarioController::class, 'usuariosCXC'])->name('usuarios-cxc');
Route::get('usuarios-mov/{usuario}', [UsuarioController::class, 'usuariosMOV'])->name('usuarios-mov');
Route::get('usuarios-rpend', [UsuarioController::class, 'usuariosRPEND'])->name('usuarios-rpend');
Route::get('usuarios-rpend-adm/{usuario}', [UsuarioController::class, 'usuariosRPENDADM'])->name('usuarios-rpend-adm');
Route::post('usuarios-pagos', [UsuarioController::class, 'usersPAGO'])->name('usuarios-pagos');
Route::get('usuarios-deudaform', [UsuarioController::class, 'usuariosDEUDAFORM'])->name('usuarios-deudaform');
Route::post('usuarios-pago-deudant', [UsuarioController::class, 'usersDEUDA'])->name('usuarios-pago-deudant');
Route::get('usuarios-movimientos', [UsuarioController::class, 'usuariosMOVIMIENTOS'])->name('usuarios-movimientos');
Route::get('usuarios-edocta-pdf', [UsuarioController::class, 'pdfEDOCTA'])->name('usuarios-edocta-pdf');
Route::get('usuarios-edoctau-pdf/{usuario}', [UsuarioController::class, 'pdfUEDOCTA'])->name('usuarios-edoctau-pdf');

/***************************** */

Route::resource('gastos', GastoController::class)->names('gastos');
Route::get('gastos-proveedores', [GastoController::class, 'gastosPROVEE'])->name('gastos-proveedores');
Route::get('gastos-ctaprov', [GastoController::class, 'ctaPROVEEDOR'])->name('gastos-ctaprov');
Route::get('gastos-cxpdf', [GastoController::class, 'cxpPDF'])->name('gastos-cxpdf');
Route::get('gastos-consulta-ctaprov', [GastoController::class, 'consultaPROVEEDOR'])->name('gastos-consulta-ctaprov');

/***************************** */

Route::resource('comunicados', ComunicadoController::class)->names('comunicados');
Route::get('create-pdf/{comunicado}', [ComunicadoController::class, 'createPDF'])->name('create-pdf');
Route::get('show-pdf', [ComunicadoController::class, 'showPDF'])->name('show-pdf');

/******************************** */

Route::resource('facturas', FacturaController::class)->names('facturas');
Route::get('detalles-factura/{factura}', [FacturaController::class, 'detallesFACTURA'])->name('detalles-factura');
Route::get('validar-gasto/{factura}', [FacturaController::class, 'validarGASTO'])->name('validar-gasto');
Route::get('validar-gastonc/{factura}', [FacturaController::class, 'validarGASTONC'])->name('validar-gastonc');
Route::delete('detalle-destroy/{fdetalle}', [FacturaController::class, 'destroyDETALLE'])->name('detalle-destroy');
Route::delete('detallenc-destroy/{gnoc}', [FacturaController::class, 'destroyDETALLENC'])->name('detallenc-destroy');
Route::get('cerrar-factura/{factura}', [FacturaController::class, 'cerrarFACTURA'])->name('cerrar-factura');
Route::get('ver-ctasxc', [FacturaController::class, 'verCTASXC'])->name('ver-ctasxc');
Route::get('create-pdfrecpen', [FacturaController::class, 'createPDFRECPEN'])->name('create-pdfrecpen');
Route::get('ver-recobro/{cuentas}', [FacturaController::class, 'verRECOBRO'])->name('ver-recobro');
Route::get('create-pdfrecobro/{ctasc}', [FacturaController::class, 'createPDFRECOBRO'])->name('create-pdfrecobro');

/********************************** */

Route::resource('pagos', PagoController::class)->names('pagos');

/********************************** */

Route::resource('fondos', FondoController::class)->names('fondos');
Route::get('fondos-finanzas', [FondoController::class, 'fondosFINANZAS'])->name('fondos-finanzas');
Route::get('fondos-egresos', [FondoController::class, 'fondosEGRESOS'])->name('fondos-egresos');
Route::get('fondos-reservas', [FondoController::class, 'reservas'])->name('fondos-reservas');
Route::post('fondos-reservas-create', [FondoController::class, 'reservasCREATE'])->name('fondos-reservas-create');
Route::get('fondos-pagos/{temp}', [FondoController::class, 'fondosPAGOS'])->name('fondos-pagos');
Route::post('fondos-pagos-cxp', [FondoController::class, 'fondosPAGOSCXP'])->name('fondos-pagos-cxp');
Route::get('fondos-gastosmes-pdf', [FondoController::class, 'pdfGASTOSMES'])->name('fondos-gastosmes-pdf');
Route::get('fondos-pdf', [FondoController::class, 'pdfONDOS'])->name('fondos-pdf');
Route::get('fondos-morosos-pdf', [FondoController::class, 'pdfMOROSOS'])->name('fondos-morosos-pdf');
Route::get('fondos-deudante-pdf', [FondoController::class, 'pdfDEUDANTE'])->name('fondos-deudante-pdf');

/********************************** */

Route::get('ver-conciliar-pagos', [PagoController::class, 'verconciliarPAGOS'])->name('ver-conciliar-pagos');
Route::get('conciliar-pagos/{pago}', [PagoController::class, 'conciliarPAGOS'])->name('conciliar-pagos');
Route::get('conciliar-deuda/{saldo}', [PagoController::class, 'conciliarDEUDA'])->name('conciliar-deuda');

/********************************** */

Route::resource('saldos', SaldoController::class)->names('saldos');

/*****************************************/
Route::get('ctasinc', [CtasiController::class, 'index'])->name('ctasinc');
Route::get('ctasinc-pdf', [CtasiController::class, 'ctasincPDF'])->name('ctasinc-pdf');

/*Route::get('buzon', [BuzonController::class, 'index'])->name('buzon.index');
Route::post('buzon',[BuzonController::class, 'store'])->name('buzon.store');
Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::put('usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');*/

