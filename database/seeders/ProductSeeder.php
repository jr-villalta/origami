<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel bond',
            'descripcion' => 'Papel bond tamaño carta',
            'cantidad' => 0,
            'precio_venta' => 5,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Activo'
        ]);
        
        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Cartón',
            'descripcion' => 'Cartón tamaño carta',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Activo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Tijeras',
            'descripcion' => 'Tijera de acero inoxidable',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Activo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Pegamento',
            'descripcion' => 'Pegamento blanco',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Activo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Cinta adhesiva',
            'descripcion' => 'Cinta adhesiva transparente',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel crepé',
            'descripcion' => 'Papel crepé de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel celofán',
            'descripcion' => 'Papel celofán de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel china',
            'descripcion' => 'Papel china de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel lustre',
            'descripcion' => 'Papel lustre de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel seda',
            'descripcion' => 'Papel seda de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

        \App\Models\Product::create([
            'id_categoria' => 1,
            'nombre' => 'Papel de regalo',
            'descripcion' => 'Papel de regalo de colores',
            'cantidad' => 0,
            'precio_venta' => 10,
            'stock_minimo' => 1,
            'cantidad_sugerida' => 1,
            'estado' => 'Desactivo'
        ]);

    }
}
