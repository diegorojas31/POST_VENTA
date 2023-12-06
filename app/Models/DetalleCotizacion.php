<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    use HasFactory;
    protected $table = 'detalle_cotizacion';
    protected $fillable = ['subtotal', 'cantidad', 'id_producto', 'id_cotizacion','delete_detalle_cotizacion'];
}
