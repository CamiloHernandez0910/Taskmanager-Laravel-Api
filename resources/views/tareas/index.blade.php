<!-- resources/views/tareas/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Tareas</title>
</head>
<body>
    <h1>Lista de Tareas</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Botón para crear nueva tarea -->
    <a href="{{ route('tareas.create') }}">➕ Nueva Tarea</a>

    <!-- Listado de tareas -->
    <ul>
        @forelse($tareas as $tarea)
            <li>
                <strong>{{ $tarea->titulo }}</strong> <br>
                {{ $tarea->descripcion }} <br>
                Estado: {{ $tarea->completada ? 'Completada ✅' : 'Pendiente ❌' }}

                <!-- Botón Editar -->
                <a href="{{ route('tareas.edit', $tarea->id) }}">✏️ Editar</a>

                <!-- Botón Eliminar -->
                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta tarea?')">🗑️ Eliminar</button>
                </form>
            </li>
            <hr>
        @empty
            <li>No hay tareas aún.</li>
        @endforelse
    </ul>
</body>
</html>
