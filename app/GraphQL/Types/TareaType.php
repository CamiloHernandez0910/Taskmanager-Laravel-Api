<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Tarea;

class TareaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Tarea',
        'description' => 'Una tarea',
        'model' => Tarea::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
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
            'created_at' => [
                'type' => Type::string(),
            ],
        ];
    }
}
