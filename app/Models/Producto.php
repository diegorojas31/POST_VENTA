<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $fillable = ['categoria_id', 'medida_id', 'nombre', 'descripcion', 'precio', 'barcode', 'marca', 'image','delete_producto'];

    use HasFactory;

    public function categoria()
    {
        return $this->belongTo('App\Models\Categoria');
    }

    public function medida()
    {
        return $this->belongTo('App\Models\Medida');
    }
}
