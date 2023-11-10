<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    /*  $Master=  Role::create(['name'=>'Master']);
      $Administrador=  Role::create(['name'=>'Administrador']);
      $Empleado=  Role::create(['name'=>'Empleado']);*/
     // $Master=  Role::create(['name'=>'Master']);

      Permission::create(['name'=>'Master']);

      Permission::create(['name'=>'Sucursales']);
      Permission::create(['name'=>'Inventarios']);
      Permission::create(['name'=>'Caja']);
      Permission::create(['name'=>'Ventas y Clientes']);

      
      
  
    }
}
