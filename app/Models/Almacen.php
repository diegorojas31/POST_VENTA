<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = ['inventario_id', 'nombre', 'descripcion', 'id_empresa', 'delete_almacen'];

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock');
    }

}
