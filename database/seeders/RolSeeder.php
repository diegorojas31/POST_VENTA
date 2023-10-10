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
      $Master=  Role::create(['name'=>'Master']);
      $Administrador=  Role::create(['name'=>'Administrador']);
      $Empleado=  Role::create(['name'=>'Empleado']);

      Permission::create(['name'=>'Master'])->syncRoles([$Master]);
      Permission::create(['name'=>'Admin'])->syncRoles([$Master,$Administrador]);
      Permission::create(['name'=>'Empleado'])->syncRoles([$Master,$Administrador,$Empleado]);
    }
}
