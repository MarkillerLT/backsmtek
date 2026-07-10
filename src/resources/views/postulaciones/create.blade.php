<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trabaja con nosotros</title>
</head>
<body>

<h1>Trabaja con nosotros</h1>
@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('postulacion.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <label>Nombre</label><br>
    <input type="text" name="nombre"><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo"><br><br>

    <label>Teléfono</label><br>
    <input type="text" name="telefono"><br><br>

    <label>Puesto</label><br>
    <input type="text" name="puesto"><br><br>

    <label>Mensaje</label><br>
    <textarea name="mensaje"></textarea><br><br>

    <label>Currículum (PDF)</label><br>
    <input
        type="file"
        name="cv"
        accept=".pdf,application/pdf"><br><br>

    <button type="submit">
        Enviar solicitud
    </button>

</form>

</body>
</html>
