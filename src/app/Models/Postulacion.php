<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'puesto',
        'mensaje',
        'cv',
        'estado',
    ];
}
