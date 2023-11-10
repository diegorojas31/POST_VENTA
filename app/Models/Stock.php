<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['producto_id', 'almacen_id', 'cantidad', 'minimo', 'maximo','delete_stock'];

    use HasFactory;

    public function almacen()
    {
        return $this->belongsTo('App\Models\Almacen', 'almacen_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }    
}
