<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'cantidad',
        'precio_venta',
        'stock_minimo',
        'cantidad_sugerida',
        'estado'
    ];
}
