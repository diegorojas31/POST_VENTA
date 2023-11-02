<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    protected $table = 'tipos_pagos';
    protected $fillable = ['tipo_pago', 'descripcion_tipo','delete_tipo_pago'];
}
