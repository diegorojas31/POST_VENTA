<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cargos;
use App\Models\Inventario;
use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        TipoPago::create([
            'tipo_pago'=> 'Efectivo',
            'descripcion_tipo' => 'Todo tipo de pago en efectivo',

        ]);
        TipoPago::create([
            'tipo_pago'=> 'Qr',
            'descripcion_tipo' => 'Todo tipo de pago en Qr',
            
        ]);
        TipoPago::create([
            'tipo_pago'=> 'Qr',
            'descripcion_tipo' => 'Todo tipo de pago en Tarjeta',
            
        ]);

        $this->call(RolSeeder::class);
        Cargos::create([
            'nombre_cargo' => 'Administrador',
            'descripcion_cargo' => 'Tiene autoridad para configurar y personalizar todos los aspectos del sistema, incluyendo la administración de usuarios,
            la configuración de permisos, la gestión de inventario',
        ]);

        Cargos::create([
            'nombre_cargo' => 'Cajero',
            'descripcion_cargo' => 'Responsable de realizar transacciones de venta
               en el punto de venta',

        ]);

        Inventario::create([
            'tipo' => 'Inventario de Venta'
        ]);
        Inventario::create([
            'tipo' => 'Inventario de Produccion'
        ]);
    }
}
