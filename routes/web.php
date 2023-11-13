<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CajaAperturaController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SuscripcionesController;
use App\Http\Controllers\Reportes\ReporteStockController;
use App\Http\Controllers\Reportes\ReporteVentasController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('Pagina');

Route::get('/getMail', [MailController::class, 'getMail']);

Auth::routes();
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified', 'can:Master']], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Master"
    Route::get('abrir_crear_users', [App\Http\Controllers\UsersController::class, 'abrir_crear_users'])->name('abrir_crear_users');
    Route::post('crear_empleado_users', [App\Http\Controllers\UsersController::class, 'crear_empleado_users'])->name('crear_empleado_users');
    Route::get('abrir_all_users', [App\Http\Controllers\UsersController::class, 'abrir_all_users'])->name('abrir_all_users');
    Route::get('user_delete/{id}', [App\Http\Controllers\UsersController::class, 'user_delete'])->name('user_delete');
    Route::get('update_rol/{id}/{nuevo_rol}', [App\Http\Controllers\UsersController::class, 'update_rol'])->name('update_rol');
    Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::get('abrir_crear_roles', [RolesController::class, 'abrir_crear_roles'])->name('abrir_crear_roles');
    Route::post('crear_roles', [RolesController::class, 'crear_roles'])->name('crear_roles');
    Route::get('all_roles', [RolesController::class, 'all_roles'])->name('all_roles');
    Route::get('abrir_suscripciones', [SuscripcionesController::class, 'abrir_suscripciones'])->name('abrir_suscripciones');
    Route::get('añadir_metodo_pago/{paymentMethod}', [SuscripcionesController::class, 'añadir_metodo_pago'])->name('añadir_metodo_pago');
    Route::get('/descargar-bitacora', [BitacoraController::class, 'descargarBitacora'])->name('descargar.bitacora');
    Route::post('desencryptar_bitacora', [BitacoraController::class, 'desencryptar_bitacora'])->name('desencryptar_bitacora');
    Route::get('mostrar_bitacora', [BitacoraController::class, 'mostrar_bitacora'])->name('mostrar_bitacora');
    


    Route::get('/reportes/stock', [ReporteStockController::class, 'index'])->name('reportes');
    Route::get('/reportes/stock/analitico', [ReporteStockController::class, 'reporteAnalitico'])->name('stock_analitico');
    Route::get('/reportes/stock/ejecutivo', [ReporteStockController::class, 'reporteEjecutivo'])->name('stock_ejecutivo');
    Route::get('/reportes/venta', [ReporteVentasController::class, 'index'])->name('reportes.ventas');
    Route::get('/reportes/venta/analitico', [ReporteVentasController::class, 'reporteAnalitico'])->name('venta_analitico');
    Route::get('/reportes/venta/ejecutivo', [ReporteVentasController::class, 'reporteEjecutivo'])->name('venta_ejecutivo');


});

Route::group(['middleware' => ['auth', 'verified', 'can:Sucursales']], function () {
  
});
Route::group(['middleware' => ['auth', 'verified', 'can:Inventarios']], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Admin"
    /** -----------------------------MODULO DE INVENTARIO---------------------------------*/
    Route::resource('dashboard/inventario/categorias', CategoriaController::class);
    Route::resource('dashboard/inventario/productos', ProductoController::class);
    Route::resource('dashboard/inventario/medidas', MedidaController::class);
    Route::resource('/dashboard/inventario/marcas', MarcaController::class);
    Route::resource('/dashboard/inventario/almacenes', AlmacenController::class);

   
});
Route::group(['middleware' => ['auth', 'verified', 'can:Caja']], function () {



    /** ---------------------MODULO DE CAJA------------------------------- */
    Route::get('/caja/index', [CajaController::class, 'index'])->name('caja.index');
    Route::get('caja/create', [CajaController::class, 'create'])->name('caja.create');
    Route::post('caja/index', [CajaController::class, 'store'])->name('caja.store');

    Route::get('caja/{id}', [CajaController::class, 'show'])->name('caja.show');
    Route::get('caja/{caja}/edit', [CajaController::class, 'edit'])->name('caja.edit');
    Route::get('caja/{caja}/eliminar', [CajaController::class, 'destroy'])->name('caja.delete');
    Route::put('caja/{caja}', [CajaController::class, 'update'])->name('caja.update');

    Route::get('obtener_datos_cajaventa/{id_cajaventa}', [CajaController::class, 'obtener_datos_cajaventa'])->name('obtener_datos_cajaventa');

});
Route::group(['middleware' => ['auth', 'verified', 'can:Ventas y Clientes']], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Admin"

    Route::get('apertura',[CajaAperturaController::class,'index'])->name('apertura.index');
    Route::get('apertura/{caja}',[CajaAperturaController::class,'show'])->name('apertura.show');
    Route::get('/apertura/{caja}/create', [CajaAperturaController::class,'create'])->name('apertura.create');
    Route::post('apertura/index/{caja}',[CajaAperturaController::class,'store'])->name('apertura.store');
    Route::match(['get', 'put'], 'apertura/in/{caja}', [CajaAperturaController::class, 'stores'])->name('apertura.stores');
    Route::post('cerrar_caja',[CajaAperturaController::class,'cerrar_caja'])->name('cerrar_caja');

    Route::get('obtener_datos_cajaventa/{id_cajaventa}', [CajaController::class, 'obtener_datos_cajaventa'])->name('obtener_datos_cajaventa');

    Route::get('allventas', [VentasController::class, 'allventas'])->name('allventas');
    route::get('abrir_ventas/{cajaventa_id}', [VentasController::class, 'abrir_ventas'])->name('abrir_ventas');
    //Route::get('allventas_caja/{caja_id}',[App\Http\Controllers\UsersController::class,'allventas_caja'])->name('allventas_caja');
    Route::get('/buscar_producto/{search}', [VentasController::class, 'buscar_producto'])->name('buscar_producto');
    Route::post('registrar_venta', [VentasController::class, 'registrar_venta'])->name('registrar_venta');
    Route::get('/generarpdfventas/{idventa}', [VentasController::class, 'generarpdfventas'])->name('generarpdfventas');


    Route::get('/buscar-por-nit/{nit}', [ClienteController::class, 'buscarPorNit'])->name('buscarPorNit');
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/crear_clientes', [ClienteController::class, 'abrir_create_clientes'])->name('abrir_create_clientes');
    Route::post('crear_cliente', [ClienteController::class, 'crear_cliente'])->name('crear_cliente');
    Route::delete('delete_cliente/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Aquí van las rutas que solo pueden ser accedidas por usuarios autenticados

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Ruta para mostrar el formulario de solicitud de restablecimiento de contraseña
    Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

    // Ruta para enviar el correo electrónico de restablecimiento de contraseña
    Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    // Ruta para mostrar el formulario de restablecimiento de contraseña con el token
    Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');

    // Ruta para procesar el restablecimiento de contraseña
    Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');


    /**------------------------------RUTAS PARA LOS USERS---------------------------- */

    Route::get('abrir_edit_users', [App\Http\Controllers\UsersController::class, 'abrir_edit_users'])->name('abrir_edit_users');
    Route::post('cambiar_contraseña', [App\Http\Controllers\UsersController::class, 'cambiar_contraseña'])->name('cambiar_contraseña');
    Route::post('update_perfil', [App\Http\Controllers\UsersController::class, 'update_perfil'])->name('update_perfil');






   

    Route::get('/notificaciones', [NotificacionesController::class, 'index'])->name('notificaciones');
});
