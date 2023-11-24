<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Configuracion;
use App\Models\Pedido;

class FacturaController extends Controller
{
    public function generarFactura($idPedido)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $productos = $pedido->productos;
        $configuracion = Configuracion::first(); // Asume que solo hay una fila en la tabla de configuración

        $pdf = PDF::loadView('facturas.factura', compact('pedido', 'configuracion', 'productos'));

        return $pdf->download('factura.pdf');
    }
}
