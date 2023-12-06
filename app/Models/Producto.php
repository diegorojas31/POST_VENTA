<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $fillable = ['categoria_id', 'medida_id', 'nombre', 'descripcion', 'precio', 'barcode', 'marca_id', 'image','delete_producto','empresa_id'];

    use HasFactory;

    public function medida()
    {
        return $this->belongsTo(Medida::class, 'medida_id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'producto_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVentas::class, 'id_producto');
    }
}
