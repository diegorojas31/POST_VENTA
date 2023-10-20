<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $table = 'cajas';
    protected $fillable = ['title_caja', 'estado', 'delete_caja','id_empresa'];
}
