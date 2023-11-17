<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuracion';
    protected $fillable = [
        'logo_empresa',
        'nombre_empresa',
        'direccion',
        'correo',
        'numero_telefono',
        'url_sitio',
        'iva',
    ];
}
