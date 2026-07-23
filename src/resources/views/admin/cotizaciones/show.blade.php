<x-app-layout>

    <x-slot name="header">
        <h2>Detalle de Cotización</h2>
    </x-slot>


    <div>

        <h3>Cotización #{{ $cotizacion->id }}</h3>

        <p>
            <strong>Nombre:</strong>
            {{ $cotizacion->nombre }}
        </p>

        <p>
            <strong>Empresa:</strong>
            {{ $cotizacion->empresa ?? 'No especificada' }}
        </p>

        <p>
            <strong>Correo:</strong>
            {{ $cotizacion->correo }}
        </p>

        <p>
            <strong>Teléfono:</strong>
            {{ $cotizacion->telefono }}
        </p>

        <p>
            <strong>Asunto:</strong>
            {{ $cotizacion->asunto }}
        </p>

        <p>
            <strong>Mensaje:</strong>
        </p>

        <p>
            {{ $cotizacion->mensaje }}
        </p>


        <hr>


        <form action="{{ route('admin.cotizaciones.update', $cotizacion) }}" method="POST">

            @csrf
            @method('PUT')


            <label for="estado">
                Estado
            </label>

            <select name="estado" id="estado">

                <option value="pendiente"
                    {{ $cotizacion->estado == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="en_proceso"
                    {{ $cotizacion->estado == 'en_proceso' ? 'selected' : '' }}>
                    En proceso
                </option>

                <option value="respondida"
                    {{ $cotizacion->estado == 'respondida' ? 'selected' : '' }}>
                    Respondida
                </option>

                <option value="cancelada"
                    {{ $cotizacion->estado == 'cancelada' ? 'selected' : '' }}>
                    Cancelada
                </option>

            </select>


            <button type="submit">
                Guardar estado
            </button>


        </form>


    </div>

</x-app-layout>
