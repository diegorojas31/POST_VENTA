<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $fillable = ['categoria_id', 'medida_id', 'nombre', 'descripcion', 'precio', 'barcode', 'marca_id', 'image','delete_producto','empresa_id'];

    use HasFactory;

    public function categoria()
    {
        return $this->belongTo('App\Models\Categoria');
    }

    public function medida()
    {
        return $this->belongsTo('App\Models\Medida', 'medida_id');
    }

    public function marca()
    {
        return $this->belongsTo('App\Models\Marca', 'marca_id');
    }    

    public function stock()
    {
        return $this->hasOne('App\Models\Stock');
    }
}
