<x-app-layout>

    <x-slot name="header">
        <h2>Cotizaciones recibidas</h2>
    </x-slot>

    <div>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($cotizaciones as $cotizacion)

                    <tr>

                        <td>{{ $cotizacion->id }}</td>

                        <td>{{ $cotizacion->nombre }}</td>

                        <td>{{ $cotizacion->empresa }}</td>

                        <td>{{ $cotizacion->correo }}</td>

                        <td>{{ $cotizacion->estado }}</td>

                        <td>{{ $cotizacion->created_at }}</td>

                        <td>
                            <a href="{{ route('admin.cotizaciones.show', $cotizacion) }}">
                                Ver
                            </a>
                        </td>

                    </tr>

                @endforeach


                @if($cotizaciones->isEmpty())

                    <tr>
                        <td colspan="7">
                            No hay cotizaciones.
                        </td>
                    </tr>

                @endif

            </tbody>

        </table>

    </div>

</x-app-layout>
