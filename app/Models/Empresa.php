<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected  $fillable = [
        'user_email',
        'razon_social',
        'giro',
        'nit',
        'exenta_iva',
        'registro_iva'
    ];
}
