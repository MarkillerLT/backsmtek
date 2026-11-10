<?php

namespace App\Exports;

use App\Models\Cotizacion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CotizacionesExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return Cotizacion::latest()->get([
            'id', 'numcontrol', 'nombre', 'empresa', 'correo',
            'telefono', 'localidad', 'tipo_cotizacion', 'otro_especificacion',
            'estado', 'asunto', 'created_at'
        ])->map(function (Cotizacion $c) {
            $fila = $c->toArray();

            return [
                $fila['id'],
                $fila['numcontrol'],
                $fila['nombre'],
                $fila['empresa'],
                $fila['correo'],
                $fila['telefono'],
                $fila['localidad'],
                $c->tipo_cotizacion_label,
                $c->tipo_cotizacion === 'otro' ? $c->otro_especificacion : null,
                $fila['estado'],
                $fila['asunto'],
                $fila['created_at'],
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Núm. Control', 'Nombre', 'Empresa', 'Correo', 'Teléfono', 'Ciudad', 'Tipo de cotización', 'Especificación', 'Estado', 'Asunto', 'Fecha'];
    }
}
