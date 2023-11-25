<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Pedido;

class VentaController extends Controller
{

public function index($fecha = null)
{
    // Si se proporciona una fecha, filtra las ventas por ese día
    $ventas = ($fecha) ? $this->obtenerVentasPorFecha($fecha) : $this->obtenerTodasLasVentas();

    // Pasa las ventas y la fecha a la vista
    return view('ventas.index', compact('ventas', 'fecha'));
}

private function obtenerVentasPorFecha($fecha)
{
    // Convierte la cadena de fecha a un objeto Carbon para facilitar la manipulación
    $fechaCarbon = Carbon::parse($fecha);

    // Lógica para obtener las ventas de un día específico
    return Pedido::whereDate('fecha_pedido', $fechaCarbon)->get(['id_cliente', 'total_pedido', 'fecha_pedido']);
}

private function obtenerTodasLasVentas()
{
    // Lógica para obtener todas las ventas
    return Pedido::all(['id_cliente', 'total_pedido', 'fecha_pedido']);
}

}
