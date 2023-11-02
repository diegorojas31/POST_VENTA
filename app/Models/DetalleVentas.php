<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $fillable = ['subtotal', 'cantidad', 'id_producto', 'id_venta','delete_detalle_venta'];

}
