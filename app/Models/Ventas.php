<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $fillable = ['montototal', 'fecha_venta', 'id_caja_venta', 'id_cliente','id_tipo_pago','delete_venta'];
}
