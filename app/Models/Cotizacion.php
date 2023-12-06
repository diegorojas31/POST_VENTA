<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones';
    protected $fillable = ['montototal', 'fecha_cotizacion', 'id_usuario', 'id_cliente','delete_cotizacion','fecha_limitecot'];
}
