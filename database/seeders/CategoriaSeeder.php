<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Categoria::create([
            'nombre' => 'Otros',
        ]);

        \App\Models\Categoria::create([
            'nombre' => 'Utiles',
        ]);

        \App\Models\Categoria::create([
            'nombre' => 'Accesorios',
        ]);

        \App\Models\Categoria::create([
            'nombre' => 'Pegamento',
        ]);

        \App\Models\Categoria::create([
            'nombre' => 'Tijeras',
        ]);

        \App\Models\Categoria::create([
            'nombre' => 'Papel',
        ]);

    }
}
