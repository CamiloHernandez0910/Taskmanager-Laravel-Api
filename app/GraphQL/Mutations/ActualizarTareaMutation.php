<?php

namespace App\GraphQL\Mutations;

use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class ActualizarTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'actualizarTarea',
    ];

    public function type(): Type
    {
        return GraphQL::type('Tarea');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'titulo' => [
                'type' => Type::string(),
            ],
            'descripcion' => [
                'type' => Type::string(),
            ],
            'completada' => [
                'type' => Type::boolean(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $tarea = Tarea::findOrFail($args['id']);

        // Solo actualiza los campos que se enviaron
        if (isset($args['titulo'])) {
            $tarea->titulo = $args['titulo'];
        }
        if (isset($args['descripcion'])) {
            $tarea->descripcion = $args['descripcion'];
        }
        if (isset($args['completada'])) {
            $tarea->completada = $args['completada'];
        }

        $tarea->save();

        return $tarea;
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tareas,id'],
            'titulo' => ['sometimes', 'string', 'min:3', 'max:50'],
            'descripcion' => ['nullable', 'string'],
            'completada' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(array $args = []): array
    {
        return [
            'id.required' => 'El ID de la tarea es obligatorio.',
            'id.exists' => 'No se encontró ninguna tarea con ese ID.',
            'titulo.min' => 'El título debe tener al menos :min caracteres.',
            'completada.boolean' => 'El campo completada debe ser verdadero o falso.',
        ];
    }

}
