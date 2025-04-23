<!-- resources/views/tareas/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Crear Nueva Tarea</title>
</head>
<body>
    <h1>Crear Nueva Tarea</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de creación -->
    <form action="{{ route('tareas.store') }}" method="POST">
        @csrf

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea><br><br>

        <button type="submit">✅ Guardar Tarea</button>
    </form>

    <br>
    <a href="{{ route('tareas.index') }}">⬅️ Volver a la lista</a>
</body>
</html>
