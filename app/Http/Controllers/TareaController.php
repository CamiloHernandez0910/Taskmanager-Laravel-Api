<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    protected function esApi(Request $request)
    {
        return $request->is('api/*');
    }

    public function index(Request $request)
    {
        $tareas = Tarea::all();

        if ($this->esApi($request)) {
            return response()->json($tareas);
        }

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'completada' => false
        ]);

        if ($this->esApi($request)) {
            return response()->json([
                'message' => 'Tarea creada correctamente',
                'data' => $tarea
            ], 201);
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean',
        ]);

        $tarea->update($request->all());

        if ($this->esApi($request)) {
            return response()->json([
                'message' => 'Tarea actualizada correctamente',
                'data' => $tarea
            ]);
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Request $request, Tarea $tarea)
    {
        $tarea->delete();

        if ($this->esApi($request)) {
            return response()->json([
                'message' => 'Tarea eliminada correctamente'
            ]);
        }

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente.');
    }

    public function filtrarTareas(Request $request)
    {
        $query = Tarea::query();

        if ($request->has('title')) {
            $query->where('titulo', 'like', '%' . $request->title . '%');
        }

        if ($request->has('completed')) {
            $completed = $request->completed === 'true' ? 1 : 0;
            $query->where('completada', $completed);
        }

        if ($request->has('sort')) {
            [$campo, $direccion] = explode(',', $request->sort);
            $query->orderBy($campo, $direccion);
        }

        $limit = $request->limit ?? 10;
        $tareas = $query->limit($limit)->get();

        return response()->json($tareas);
    }
}
