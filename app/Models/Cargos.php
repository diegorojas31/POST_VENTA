<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos';
    protected $fillable = ['nombre_cargo', 'descripcion_cargo', 'delete_cargo'];
}
