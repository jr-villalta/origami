<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImporProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            
            'nombre' => $row[0],
            'descripcion' => $row[1],
            'cantidad' => $row[2],
            'precio_venta' =>$row[3],
            'stock_minimo' => $row[4],
            'cantidad_sugerida' => $row[5],
           
        ]);
    }
}
