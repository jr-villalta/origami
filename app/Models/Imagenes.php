<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Imagenes extends Model
{
    // use HasFactory;
    protected $table = 'imagenes';
    
    protected $fillable = ['id_producto', 'enlace'];

    public function producto()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    } 
}
