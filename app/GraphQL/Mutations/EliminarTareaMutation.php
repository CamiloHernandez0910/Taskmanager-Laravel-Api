<?php

namespace App\GraphQL\Mutations;

use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class EliminarTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'eliminarTarea',
    ];

    public function type(): Type
    {
        // Devuelve un boolean para indicar éxito
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID de la tarea a eliminar',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $tarea = Tarea::findOrFail($args['id']);

        return $tarea->delete();
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tareas,id'],
        ];
    }

    public function messages(array $args = []): array
    {
        return [
            'id.required' => 'Debes proporcionar el ID de la tarea a eliminar.',
            'id.exists' => 'La tarea que intentas eliminar no existe.',
        ];
    }

}
