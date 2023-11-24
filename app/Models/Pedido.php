<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cliente',
        'fecha_pedido',
        'total_pedido',
        'retiro_tienda',
        'forma_pago',
        'estado',
    ];

    public function productos()
    {
        return $this->hasMany(ProductoPedido::class, 'id_pedido');
    }

    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_pedido');
    }

    public function envio()
    {
        return $this->hasOne(Envio::class, 'id_pedido');
    }
}
