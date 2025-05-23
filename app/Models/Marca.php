<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['inventario_id', 'nombre', 'id_empresa', 'delete_almacen'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
