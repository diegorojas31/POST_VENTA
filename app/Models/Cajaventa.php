<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajaventa extends Model
{
    use HasFactory;
    protected $table = 'cajaventas';
    protected $fillable = ['id_caja', 'id_usuario', 'saldo_inicial','saldo_final','fecha_apertura','fecha_cierre','delete_cajaventa'];
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'id_caja', 'id');
    }
}
