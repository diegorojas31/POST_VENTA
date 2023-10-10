<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;
    
    protected $fillable = ['inventario_id', 'nombre', 'descripcion', 'abreviatura', 'delete_medida'];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}
