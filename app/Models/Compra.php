<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_producto',
        'cantidad',
        'costo',
        'proveedor',
    ];

    // Relación uno a muchos (inversa)
    public function producto()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }
}
