<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background-color: #2196ba; color: #fff; }
    </style>
</head>
<body>
    <h2>Cotizaciones SMTEK</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Núm. Control</th><th>Nombre</th><th>Empresa</th>
                <th>Correo</th><th>Ciudad</th><th>Estado</th><th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotizaciones as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->numcontrol }}</td>
                    <td>{{ $c->nombre }}</td>
                    <td>{{ $c->empresa ?: '—' }}</td>
                    <td>{{ $c->correo }}</td>
                    <td>{{ $c->localidad }}</td>
                    <td>{{ ucfirst(str_replace('_',' ',$c->estado)) }}</td>
                    <td>{{ $c->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
