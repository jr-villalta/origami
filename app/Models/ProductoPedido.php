<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;
use App\Models\Product;

class ProductoPedido extends Model
{
    use HasFactory;

    protected $table = 'productos_pedidos';

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function product()
{
    return $this->belongsTo(Product::class, 'id_producto', 'id');
}
}
