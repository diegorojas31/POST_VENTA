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

Route::get('/getMail',[MailController::class,'getMail']);

Auth::routes();
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','verified', 'can:Master']], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Master"
    Route::get('abrir_crear_users',[App\Http\Controllers\UsersController::class,'abrir_crear_users'])->name('abrir_crear_users');
    Route::post('crear_empleado_users',[App\Http\Controllers\UsersController::class,'crear_empleado_users'])->name('crear_empleado_users');
    Route::get('abrir_all_users',[App\Http\Controllers\UsersController::class,'abrir_all_users'])->name('abrir_all_users');
    Route::get('user_delete/{id}',[App\Http\Controllers\UsersController::class,'user_delete'])->name('user_delete');
    Route::get('update_rol/{id}/{nuevo_rol}',[App\Http\Controllers\UsersController::class,'update_rol'])->name('update_rol');
    Route::get('bitacora',[BitacoraController::class,'index'])->name('bitacora.index');
});

Route::group(['middleware' => ['auth','verified','can:Admin']], function () {
    // Rutas Autenticadas que solo pueden ser accedidas por usuarios con el rol "Admin"
        /** -----------------------------MODULO DE INVENTARIO---------------------------------*/
        Route::resource('dashboard/inventario/categorias', CategoriaController::class);
        Route::resource('dashboard/inventario/productos', ProductoController::class);
        Route::resource('dashboard/inventario/medidas', MedidaController::class);
        Route::resource('/dashboard/inventario/marcas', MarcaController::class);
        Route::resource('/dashboard/inventario/almacenes', AlmacenController::class);
        
     /** ---------------------MODULO DE CAJA------------------------------- */
    Route::get('/caja/index',[CajaController::class,'index'])->name('caja.index');
    Route::get('caja/create',[CajaController::class,'create'])->name('caja.create');
    Route::post('caja/index',[CajaController::class,'store'])->name('caja.store');
    
    Route::get('caja/{id}',[CajaController::class,'show'])->name('caja.show');
    Route::get('caja/{caja}/edit',[CajaController::class,'edit'])->name('caja.edit');
    Route::get('caja/{caja}/eliminar',[CajaController::class, 'destroy'])->name('caja.delete');
    Route::put('caja/{caja}',[CajaController::class,'update'])->name('caja.update');

    Route::get('obtener_datos_cajaventa/{id_cajaventa}',[CajaController::class, 'obtener_datos_cajaventa'])->name('obtener_datos_cajaventa');
    
    Route::get('allventas', [VentasController::class, 'allventas'])->name('allventas');

});

Route::middleware(['auth','verified'])->group(function () {
    // Aquí van las rutas que solo pueden ser accedidas por usuarios autenticados

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    

    /**------------------------------RUTAS PARA LOS USERS---------------------------- */
   
    Route::get('abrir_edit_users',[App\Http\Controllers\UsersController::class,'abrir_edit_users'])->name('abrir_edit_users');
    Route::post('cambiar_contraseña',[App\Http\Controllers\UsersController::class,'cambiar_contraseña'])->name('cambiar_contraseña');
    Route::post('update_perfil',[App\Http\Controllers\UsersController::class,'update_perfil'])->name('update_perfil');



    Route::get('apertura',[CajaAperturaController::class,'index'])->name('apertura.index');
    Route::get('apertura/{caja}',[CajaAperturaController::class,'show'])->name('apertura.show');
    Route::get('/apertura/{caja}/create', [CajaAperturaController::class,'create'])->name('apertura.create');
    Route::post('apertura/index/{caja}',[CajaAperturaController::class,'store'])->name('apertura.store');
    Route::match(['get', 'put'], 'apertura/in/{caja}', [CajaAperturaController::class, 'stores'])->name('apertura.stores');
    Route::post('cerrar_caja',[CajaAperturaController::class,'cerrar_caja'])->name('cerrar_caja');


    route::get('abrir_ventas/{cajaventa_id}',[VentasController::class,'abrir_ventas'])->name('abrir_ventas');
    //Route::get('allventas_caja/{caja_id}',[App\Http\Controllers\UsersController::class,'allventas_caja'])->name('allventas_caja');
    Route::get('/buscar_producto/{search}', [VentasController::class, 'buscar_producto'])->name('buscar_producto');
    Route::post('registrar_venta', [VentasController::class, 'registrar_venta'])->name('registrar_venta');
    Route::get('/generarpdfventas/{idventa}', [VentasController::class, 'generarpdfventas'])->name('generarpdfventas');


    Route::get('/buscar-por-nit/{nit}', [ClienteController::class, 'buscarPorNit'])->name('buscarPorNit');
    Route::get('clientes',[ClienteController::class,'index'])->name('clientes.index');
    Route::get('/crear_clientes',[ClienteController::class,'abrir_create_clientes'])->name('abrir_create_clientes');
    Route::post('crear_cliente',[ClienteController::class,'crear_cliente'])->name('crear_cliente');
    Route::delete('delete_cliente/{id}',[ClienteController::class,'destroy'])->name('clientes.destroy');

    Route::get('/notificaciones', [NotificacionesController::class, 'index'])->name('notificaciones');
    

});




