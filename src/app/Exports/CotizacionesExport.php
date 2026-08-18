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
            'telefono', 'localidad', 'estado', 'asunto', 'created_at'
        ]);
    }

    public function headings(): array
    {
        return ['ID', 'Núm. Control', 'Nombre', 'Empresa', 'Correo', 'Teléfono', 'Ciudad', 'Estado', 'Asunto', 'Fecha'];
    }
}
