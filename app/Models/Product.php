<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Imagenes;

class Product extends Model
{
    use HasFactory;

    public function imagenes()
    {
        return $this->hasMany(Imagenes::class, 'id_producto');
    }

    protected  $fillable = [
        'id',
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
