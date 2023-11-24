<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ProductoPedido;
use App\Models\Factura;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Asegura que el usuario esté autenticado
    }

    public function index()
    {
        // Obtén los pedidos que deseas mostrar
        $pedidos = Pedido::where('id_cliente', '=' , auth()->id())->get();

        // Pasa los pedidos a la vista
        return view('pedidos.index', compact('pedidos'));
    }


    public function realizarPedido(Request $request)
    {
        // Obtener el carrito actual de la sesión
        $carritoActual = session('carrito') ? session('carrito') : [];

        if ($request->input('entrega') == 'domicilio') {
            $direccionEnvio = $request->input('direccion_envio');
            if (!$direccionEnvio) {
                return redirect()->back()->with('error', 'La dirección de envío es obligatoria para la entrega a domicilio.');
            }
        }

        // Verificar si hay productos en el carrito
        if (empty($carritoActual)) {
            return redirect()->route('ruta.donde.redirigir')->with('error', 'No hay productos en el carrito.');
        }

        // Crear un nuevo pedido
        $pedido = new Pedido();
        $pedido->id_cliente = Auth::id(); // Asignar el ID del cliente autenticado
        $pedido->fecha_pedido = now(); // Fecha actual
        $pedido->total_pedido = $this->calcularTotalPedido($carritoActual); // Método para calcular el total
        $pedido->retiro_tienda = $request->input('entrega') == 'tienda';
        $pedido->forma_pago = $request->input('pago');
        $pedido->estado = 'pendiente'; // Puedes ajustar el estado según tu lógica
        $pedido->save();

        // Agregar los productos al pedido en la tabla intermedia (productos_pedidos)
        foreach ($carritoActual as $productoCarrito) {
            $productoPedido = new ProductoPedido([
                'id_producto' => $productoCarrito['id'],
                'cantidad' => $productoCarrito['cantidad'],
            ]);

            $pedido->productos()->save($productoPedido);
        }

        // Crear una factura asociada al pedido
        $factura = new Factura();

        // Configurar el estado de la factura según el método de pago
        if ($request->input('pago') == 'tarjeta') {
            $factura->estado = 'pagada';
        } else {
            $factura->estado = 'pendiente';
        }

        $pedido->factura()->save($factura);

        if ($request->input('entrega') == 'domicilio') {
        $envio = new Envio([
            'direccion_envio' => $direccionEnvio,
            'estado' => 'pendiente',
        ]);

        $pedido->envio()->save($envio);
        }

        // Limpiar el carrito después de realizar el pedido
        session(['carrito' => []]);

        return redirect()->route('pedidos.index')->with('mensaje', 'Pedido realizado con éxito.');    
    }

    // Método para calcular el total del pedido
    private function calcularTotalPedido($carrito)
    {
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio_unitario'] * $item['cantidad'];
        }

        return $total;
    }
}
