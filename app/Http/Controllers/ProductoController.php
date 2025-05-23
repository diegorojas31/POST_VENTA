<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;

use App\Models\Stock;
use App\Models\Medida;
use App\Models\Almacen;
use App\Models\Producto;
use Milon\Barcode\DNS1D;
use App\Models\Categoria;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Notifications\StockBajo;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.producto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);

        $tiposDeCodigoDeBarras = [
            'EAN8' => 'EAN8',
            'EAN13' => 'EAN13',
            'UPCA' => 'UPCA',
            'C128' => 'C128'
        ];

        $marcas = Marca::where('delete_marca', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');

        $almacens = Almacen::where('delete_almacen', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');
        $categorias = Categoria::where('delete_categoria', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');
        $medidas = Medida::where('delete_medida', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');

        return view('inventario.producto.create', compact('categorias', 'medidas', 'tiposDeCodigoDeBarras', 'marcas', 'almacens'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)

    {
        // dd($request);
        // Crear una regla de validación personalizada para el campo barcode
        $validator = Validator::make($request->all(), [
            'nombre' => [
                'required',
                Rule::unique('productos')->where(function ($query) {
                    $query->where('delete_producto', 1);
                }),
                'max:50',
            ],
            'file' => 'image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required',
            'barcode' => [
                'required_if:auto,false', // No requerido si 'auto' es falso
                'unique:productos',
                function (
                    $attribute,
                    $value,
                    $fail
                ) use ($request) {
                    $tipoCodigo = $request->input('tipo_codigo');
                    $validLengths = [
                        'EAN8' => 7,
                        'EAN13' => 12,
                        'UPCA' => 11,
                        'C128' => null, // Permitir cualquier cantidad de caracteres
                    ];

                    if (!$request->auto && !array_key_exists($tipoCodigo, $validLengths)) {
                        $fail('El tipo de código no es válido');
                    }

                    if ($tipoCodigo !== 'C128' && strlen($value) !== $validLengths[$tipoCodigo]) {
                        $fail('El código de barras debe tener ' . $validLengths[$tipoCodigo] . ' dígitos para el tipo ' . $tipoCodigo);
                    }
                },
            ],
            'medida_id' => 'required',
            'precio' => 'integer|min:0',
            'cantidad' => 'required|integer|min:0',
            'minimo' => 'required|integer|min:0',
            'maximo' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userId = Auth::id();
        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        // Crear y guardar el producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->marca_id = $request->input('marca_id');
        $producto->empresa_id = $datos->empresa_id;

        $producto->categoria_id = $request->input('categoria_id');
        $producto->medida_id = $request->input('medida_id'); // Corregir el campo medida_id
        $producto->precio = $request->input('precio');

        if ($request->file('file')) {
            $url = Storage::put('productos', $request->file('file'));
            // dd($url);
            $producto->image = 'storage/' . $url;
        } else {
            $producto->image = 'images/no-image.png';
        }

        $producto->tipo_codigo = $request->input('tipo_codigo');

        if ($request->auto) {
            $tipoCodigo = $request->input('tipo_codigo');
            $generatedBarcode = $this->generateUniqueBarcode($tipoCodigo);

            $producto->barcode = $generatedBarcode;
        } else {
            // Asignar el código introducido
            $producto->barcode = $request->input('barcode');
        }


        $producto->save();
        

        // Crear y guardar el registro de stock
        $stock = new Stock();
        $stock->producto_id = $producto->id;
        $stock->cantidad = $request->input('cantidad');
        $stock->almacen_id = $request->input('almacen_id');
        $stock->minimo = $request->input('minimo');
        $stock->maximo = $request->input('maximo');

        $stock->save();

         //---------------------------------------BITACORA---------------------------

         $user = User::find($userId);

         $ipUsuario = request()->ip();
         $activity=Activity()
             ->causedBy($user->id)
             ->inLog($user->name)
             ->performedOn($producto)
             ->withProperties([
                 'categoria_id' => $producto->categoria_id,
                 'medida_id' => $producto->medida_id,
                 'nombre_producto' => $producto->nombre,
                 'descripcion_prod' => $producto->descripcion,
                 'precio_prod' => $producto->precio,
                 'barcode' => $producto->barcode,
                 'marca' => $producto->marca_id,
                 'image' => $producto->image,
                 'empresa_id' => $producto->empresa_id,
                 //stock
                 'ubicacion_stock' => $stock->ubicacion,
                 'cantidad_stock' => $stock->cantidad,
                 'minimo_stock' => $stock->minimo,
                 'maximo_stock' => $stock->maximo,
                 'ip_pc' => $ipUsuario
             ])
             ->log('Producto '. $producto->nombre .' creado por: '.$user->name)
         ;
         $idMaster = $user->empresa_id;
         $CSV = new FuncionController;
         
         $CSV->guardarEnCSV($activity, $idMaster);
 
         /////////////////////////////////////////////////////////////////////////////

        return redirect()->route('productos.create')->with('info', 'Producto creado con éxito.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
        $categoria = Categoria::find($producto->categoria_id);
        $medida = Medida::find($producto->medida_id);
        $stock = Stock::where('producto_id', $producto->id)->first();
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();

        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.producto.show', compact('producto', 'categoria', 'medida', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $userId = Auth::id();

        $datos = User::join('empresa_clientes', 'empresa_clientes.id', '=', 'users.empresa_id')
            ->where('users.id', $userId)
            ->select('*')->first();


        $categorias = Categoria::where('delete_categoria', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');
        $medidas = Medida::where('delete_medida', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');
        $stock = Stock::where('producto_id', $producto->id)
            ->first();

        $marcas = Marca::where('delete_marca', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');

        $almacens = Almacen::where('delete_almacen', 1)
            ->where('id_empresa', $datos->empresa_id)
            ->pluck('nombre', 'id');
         
        config(['adminlte.logo' => "<b>$datos->razon_social</b>"]);
        return view('inventario.producto.edit', compact('producto', 'categorias', 'medidas', 'stock', 'marcas', 'almacens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //dd($request,$producto);
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('productos')->where(function ($query) use ($producto) {
                    $query->where('delete_producto', 1)
                        ->whereNot('id', $producto->id);
                }),
                'max:50',
            ],
            'file' => 'image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required',
            'medida_id' => 'required',
            'precio' => 'integer|min:0',
            'cantidad' => 'required|integer|min:0',
            'minimo' => 'required|integer|min:0',
            'maximo' => 'required|integer|min:0',
        ]);
        $preProducto = $producto;

        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->marca_id = $request->input('marca_id');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->medida_id = $request->input('medida_id'); // Corregir el campo medida_id
        $producto->precio = $request->input('precio');

        if ($request->file('file')) {
            $url = Storage::put('productos', $request->file('file'));
            $producto->image = 'storage/' . $url;
        }

        $producto->save();

        // Crear y guardar el registro de stock
        $stock = Stock::where('producto_id', $producto->id)->first();
        $preStock = $stock;
        $stock->cantidad = $request->input('cantidad');
        $stock->almacen_id = $request->input('almacen_id');
        $stock->minimo = $request->input('minimo');
        $stock->maximo = $request->input('maximo');

        $stock->save();

        //-----------------------------BITACORA-----------------------------------------
        $userId = Auth::id();
        $user = User::find($userId);

        $ipUsuario = request()->ip();
        $activity=Activity()  
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn($producto)
            ->withProperties([
                'preCategoria_id' => $preProducto->categoria_id,
                'preMedida_id' => $preProducto->medida_id,
                'preNombre_producto' => $preProducto->nombre,
                'preDescripcion_prod' => $preProducto->descripcion,
                'prePrecio_prod' => $preProducto->precio,
                'preBarcode' => $preProducto->barcode,
                'preMarca' => $preProducto->marca,
                'preImage' => $preProducto->image,
                'preEmpresa_id' => $preProducto->empresa_id,
                //
                'categoria_id' => $producto->categoria_id,
                'medida_id' => $producto->medida_id,
                'nombre_producto' => $producto->nombre,
                'descripcion_prod' => $producto->descripcion,
                'precio_prod' => $producto->precio,
                'barcode' => $producto->barcode,
                'marca' => $producto->marca_id,
                'image' => $producto->image,
                'empresa_id' => $producto->empresa_id,
                //stock
                'preUbicacion_stock' => $preStock->ubicacion,
                'preCantidad_stock' => $preStock->cantidad,
                'preMinimo_stock' => $preStock->minimo,
                'preMaximo_stock' => $preStock->maximo,
                //
                'ubicacion_stock' => $stock->ubicacion,
                'cantidad_stock' => $stock->cantidad,
                'minimo_stock' => $stock->minimo,
                'maximo_stock' => $stock->maximo,
                'ip_pc' => $ipUsuario
            ])
            ->log('Producto Actualizado ' . $producto->nombre)
        ;
        $idMaster = $user->empresa_id;
        $CSV = new FuncionController;
        
        $CSV->guardarEnCSV($activity, $idMaster);
        //////////////////////////////////////////////////////////////////////////////

        return redirect()->route('productos.index')->with('info', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        $producto->delete_producto = 0;
        $producto->save();

        //------------------------------------BITACORA ---------------------------
        $userId = Auth::id();
        $user = User::find($userId);
        
        $ipUsuario = request()->ip();
        $activity=Activity()
            ->causedBy($user->id)
            ->inLog($user->name)
            ->performedOn($producto)
            ->withProperties([
                'nombre' => $producto->nombre,
                'ip_pc' => $ipUsuario
            ])
            ->log('Producto: '.$producto->nombre.', ELIMINADO')
        ;
        $idMaster = $user->empresa_id;
        $CSV = new FuncionController;
        
        $CSV->guardarEnCSV($activity, $idMaster);

        ///////////////////////////////////////////////////////////////////////////
        return redirect()->route('productos.index')->with('info', 'Producto eliminado con éxito.');
    }

    // Función para generar un código de barras aleatorio
    private function generateRandomBarcode($tipoCodigo)
    {
        $validLengths = [
            'EAN8' => 7,
            'EAN13' => 12,
            'UPCA' => 11,
            'C128' => null,
        ];

        $length = $validLengths[$tipoCodigo];

        if ($length === null) {
            // Permitir cualquier cantidad de caracteres en el caso de 'C128'
            return str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        }

        // Genera un número aleatorio dentro del rango permitido
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        $generatedBarcode = rand($min, $max);

        return str_pad($generatedBarcode, $length, '0', STR_PAD_LEFT);
    }

    // Función para generar un código de barras único
    private function generateUniqueBarcode($tipoCodigo)
    {
        $generatedBarcode = $this->generateRandomBarcode($tipoCodigo);

        // Verifica si el código generado ya existe en la base de datos
        while (Producto::where('barcode', $generatedBarcode)->exists()) {
            // Si existe, genera otro código hasta que sea único
            $generatedBarcode = $this->generateRandomBarcode($tipoCodigo);
        }

        return $generatedBarcode;
    }
}
