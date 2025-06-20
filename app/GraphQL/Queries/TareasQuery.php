<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class TareasQuery extends Query
{
    protected $attributes = [
        'name' => 'tareas',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Tarea'));
    }

    public function args(): array
    {
        return [
            'titulo' => ['type' => Type::string()],
            'completada' => ['type' => Type::boolean()],
            'limit' => ['type' => Type::int()],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Tarea::query();

        if (isset($args['titulo'])) {
            $query->where('titulo', 'like', '%' . $args['titulo'] . '%'); //->where() es un método que viene del Query Builder.
        }

        if (isset($args['completada'])) {
            $query->where('completada', $args['completada']);
        }

        if (isset($args['limit'])) {
            $query->limit($args['limit']);
        }

        return $query->get();
    }
}

