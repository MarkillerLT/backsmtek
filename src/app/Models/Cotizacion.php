<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'nombre',
        'empresa',
        'correo',
        'telefono',
        'asunto',
        'mensaje',
        'estado',
    ];
}
