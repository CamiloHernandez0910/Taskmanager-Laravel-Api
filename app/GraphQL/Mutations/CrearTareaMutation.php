<?php

namespace App\GraphQL\Mutations;

use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CrearTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'crearTarea',
    ];

    public function type(): Type
    {
        return GraphQL::type('Tarea');
    }

    public function args(): array
    {
        return [
            'titulo' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'descripcion' => [
                'type' => Type::string(),
            ],
            'completada' => [
                'type' => Type::boolean(),
                'defaultValue' => false,
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Tarea::create($args);
    }

    public function rules(array $args = []): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:50'],
            'descripcion' => ['nullable', 'string'],
            'completada' => ['boolean'],
        ];
    }
    
    public function messages(array $args = []): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos :min caracteres.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            'completada.boolean' => 'El campo completada debe ser verdadero(1) o falso(0).',
        ];
    }

}
