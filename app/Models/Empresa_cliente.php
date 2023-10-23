<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa_cliente extends Model
{
    use HasFactory;
    protected $table = 'empresa_clientes';
    protected $fillable = ['razon_social', 'nit_empresa', 'nombre_titular', 'apellido_titular','celular_titular','delete_empresa'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'empresa_id');
    }
}
