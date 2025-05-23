<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['inventario_id', 'nombre', 'descripcion', 'image', 'delete_categoria','id_empresa'];

    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
