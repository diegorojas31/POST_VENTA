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
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\NotificacionesController;
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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'can:Master'], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Master"
    Route::get('abrir_crear_users', [App\Http\Controllers\UsersController::class, 'abrir_crear_users'])->name('abrir_crear_users');
    Route::post('crear_empleado_users', [App\Http\Controllers\UsersController::class, 'crear_empleado_users'])->name('crear_empleado_users');
    Route::get('abrir_all_users', [App\Http\Controllers\UsersController::class, 'abrir_all_users'])->name('abrir_all_users');
    Route::get('user_delete/{id}', [App\Http\Controllers\UsersController::class, 'user_delete'])->name('user_delete');
    Route::get('update_rol/{id}/{nuevo_rol}', [App\Http\Controllers\UsersController::class, 'update_rol'])->name('update_rol');
});

Route::group(['middleware' => 'can:Admin'], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Admin"
    /** -----------------------------MODULO DE INVENTARIO---------------------------------*/
    Route::resource('dashboard/inventario/categorias', CategoriaController::class);
    Route::resource('dashboard/inventario/productos', ProductoController::class);
    Route::resource('dashboard/inventario/medidas', MedidaController::class);
    Route::resource('/dashboard/inventario/marcas', MarcaController::class);
    Route::resource('/dashboard/inventario/almacenes', AlmacenController::class);

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

Route::middleware('auth')->group(function () {
    // Aquí van las rutas que solo pueden ser accedidas por usuarios autenticados

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    /**------------------------------RUTAS PARA LOS USERS---------------------------- */

    Route::get('abrir_edit_users', [App\Http\Controllers\UsersController::class, 'abrir_edit_users'])->name('abrir_edit_users');
    Route::post('cambiar_contraseña', [App\Http\Controllers\UsersController::class, 'cambiar_contraseña'])->name('cambiar_contraseña');
    Route::post('update_perfil', [App\Http\Controllers\UsersController::class, 'update_perfil'])->name('update_perfil');



    Route::get('apertura', [CajaAperturaController::class, 'index'])->name('apertura.index');
    Route::get('apertura/{caja}', [CajaAperturaController::class, 'show'])->name('apertura.show');
    Route::get('/apertura/{caja}/create', [CajaAperturaController::class, 'create'])->name('apertura.create');
    Route::post('apertura/index/{caja}', [CajaAperturaController::class, 'store'])->name('apertura.store');
    Route::match(['get', 'put'], 'apertura/in/{caja}', [CajaAperturaController::class, 'stores'])->name('apertura.stores');
    Route::post('cerrar_caja', [CajaAperturaController::class, 'cerrar_caja'])->name('cerrar_caja');


    route::get('abrir_ventas/{cajaventa_id}', [VentasController::class, 'abrir_ventas'])->name('abrir_ventas');
    Route::get('allventas_caja/{caja_id}', [App\Http\Controllers\UsersController::class, 'allventas_caja'])->name('allventas_caja');
    Route::get('/buscar_producto/{search}', [VentasController::class, 'buscar_producto'])->name('buscar_producto');



    Route::get('/buscar-por-nit/{nit}', [ClienteController::class, 'buscarPorNit'])->name('buscarPorNit');

    Route::get('/notificaciones', [NotificacionesController::class, 'index'])->name('notificaciones');
});
