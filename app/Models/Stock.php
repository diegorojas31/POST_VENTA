<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['producto_id', 'ubicacion', 'cantidad', 'minimo', 'maximo','delete_stock'];

    use HasFactory;
}
