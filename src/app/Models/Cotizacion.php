<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    /**
     * Tipos de cotización: valor guardado => etiqueta visible.
     */
    public const TIPOS = [
        'especializado' => 'Especializado',
        'maquinados'    => 'Maquinados',
        'proyectos'     => 'Proyectos',
        'otro'          => 'Otro',
    ];

    protected $fillable = [
        'user_id',
        'nombre',
        'empresa',
        'correo',
        'telefono',
        'asunto',
        'mensaje',
        'estado',
        'localidad',
        'numcontrol',
        'tipo_cotizacion',
        'otro_especificacion',
    ];

    /**
     * Etiqueta del tipo; "Sin clasificar" para cotizaciones anteriores al campo.
     */
    protected function tipoCotizacionLabel(): Attribute
    {
        return Attribute::get(
            fn () => self::TIPOS[$this->tipo_cotizacion] ?? 'Sin clasificar'
        );
    }
}
