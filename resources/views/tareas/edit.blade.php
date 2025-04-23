<!-- resources/views/tareas/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>

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

    <!-- Formulario de edición -->
    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $tarea->titulo) }}" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion', $tarea->descripcion) }}</textarea><br><br>

        <label for="completada">¿Está completada?</label>
        <input type="checkbox" name="completada" id="completada" value="1" {{ $tarea->completada ? 'checked' : '' }}><br><br>

        <button type="submit">💾 Actualizar Tarea</button>
    </form>

    <br>
    <a href="{{ route('tareas.index') }}">⬅️ Volver a la lista</a>
</body>
</html
