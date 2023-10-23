<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Medida;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        Categoria::truncate();
        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Chocolates',
            'descripcion' => 'Deliciosos chocolates para satisfacer tu antojo.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Productos de Limpieza',
            'descripcion' => 'Productos esenciales para mantener tu hogar limpio y ordenado.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Ropa',
            'descripcion' => 'Moda para todas las edades y ocasiones.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Electrónica',
            'descripcion' => 'Los últimos gadgets y dispositivos electrónicos.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Hogar y Jardín',
            'descripcion' => 'Todo lo que necesitas para tu hogar y jardín.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Juguetes',
            'descripcion' => 'Diversión garantizada para los más pequeños.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Salud y Belleza',
            'descripcion' => 'Productos para el cuidado de la salud y la belleza.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Alimentos Frescos',
            'descripcion' => 'Frutas, verduras y productos frescos de alta calidad.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Muebles',
            'descripcion' => 'Muebles elegantes y funcionales para tu hogar.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Libros',
            'descripcion' => 'Literatura clásica y contemporánea para todos los gustos.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Electrodomésticos',
            'descripcion' => 'Electrodomésticos esenciales para tu vida diaria.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Deportes y Fitness',
            'descripcion' => 'Equipamiento para deportes y actividades físicas.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Moda Infantil',
            'descripcion' => 'Ropa y accesorios para los más pequeños de la casa.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Mascotas',
            'descripcion' => 'Productos y accesorios para tus amigos peludos.',
            'id_empresa' => 1,
        ]);

        Categoria::create([
            'inventario_id' => 1,
            'nombre' => 'Tecnología',
            'descripcion' => 'Productos tecnológicos de vanguardia para entusiastas.',
            'id_empresa' => 1,
        ]);



        // Unidades de Medida
        Medida::truncate();
        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Metro',
            'descripcion' => 'Medida de longitud estándar.',
            'abreviatura' => 'm',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Kilogramo',
            'descripcion' => 'Medida de peso estándar.',
            'abreviatura' => 'kg',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Litro',
            'descripcion' => 'Medida de volumen estándar.',
            'abreviatura' => 'L',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Pieza',
            'descripcion' => 'Unidad individual de producto.',
            'abreviatura' => 'pc',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Docena',
            'descripcion' => 'Grupo de 12 unidades.',
            'abreviatura' => 'dz',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Mililitro',
            'descripcion' => 'Medida de volumen pequeña.',
            'abreviatura' => 'ml',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Centímetro',
            'descripcion' => 'Medida de longitud pequeña.',
            'abreviatura' => 'cm',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Pulgada',
            'descripcion' => 'Medida de longitud en el sistema imperial.',
            'abreviatura' => 'in',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Galon',
            'descripcion' => 'Medida de volumen en el sistema imperial.',
            'abreviatura' => 'gal',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Onza',
            'descripcion' => 'Medida de peso en el sistema imperial.',
            'abreviatura' => 'oz',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Libra',
            'descripcion' => 'Medida de peso en el sistema imperial.',
            'abreviatura' => 'lb',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Miligramo',
            'descripcion' => 'Pequeña unidad de peso.',
            'abreviatura' => 'mg',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Centilitro',
            'descripcion' => 'Medida de volumen pequeña.',
            'abreviatura' => 'cl',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Decímetro',
            'descripcion' => 'Medida de longitud.',
            'abreviatura' => 'dm',
        ]);

        Medida::create([
            'inventario_id' => 1,
            'id_empresa' => 1,
            'nombre' => 'Milímetro',
            'descripcion' => 'Pequeña medida de longitud.',
            'abreviatura' => 'mm',
        ]);
    }
}
