<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $fillable = ['nombre_empleado', 'apellido_empleado', 'celular_empleado', 'usuario_id','cargo_id','delete_empleado'];
}
