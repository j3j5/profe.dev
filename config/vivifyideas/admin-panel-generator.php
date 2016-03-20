<?php

return [
    'prefix' => 'admin',

    'authMiddleware' => 'auth',

    'tables' => ['users', 'propuestas', 'preguntas', 'respuestas'],

    'rowsPerPage' => 15,

    'additionalLinks' => [],

    'columns'   => [
        'users'         => ['id', 'name', 'email', 'created_at'],
        'propuestas'    => ['nombre', 'contenidos', 'thumbnail', 'archivo', 'curso', 'updated_at',],
        'preguntas'     => ['pregunta', 'practica', 'updated_at'],
        'respuestas'     => ['respuesta', 'updated_at'],
    ],

    'filters' => [
        'users' => [
            'email' => [
                'label'     => 'Email',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
            'name' => [
                'label'     => 'Nombre',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
        ],
        'propuestas' => [
            'nombre' => [
                'label'     => 'Nombre',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
            'contenidos' => [
                'label'     => 'Contenidos',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
            'curso' => [
                'label'     => 'Curso',
                'type'      => 'number',
            ],
        ],
        'preguntas' => [
            'practica'  => [
                'label' => '¿Es de práctica?',
                'type'  => 'checkbox',
            ],
            'nivel'     => [
                'label' => 'Nivel',
                'type'  => 'text'
            ],
        ],
        'respuestas' => [
//             'pregunta_id'
        ],
    ],
    'forms' => [
        'users'         => [
            'name',
            'email',
        ],
        'propuestas'    => [
            'nombre',
            'contenidos',
            'curso',
            'thumbnail',
            'archivo',
        ],
        'preguntas'     => [
            'pregunta',
            'practica' => [
                'label' => '¿Es de prácticas?',
                'type' => 'checkbox',
            ],
            'nivel' => [
                'label' => 'Nivel',
                'type' => 'number',
            ],
            'hasMany' => [
                'respuestas' => [
                    'label' => 'Respuesta',
                    'column' => 'id',
                    'foreignLabel' => 'respuesta'
                ]
            ],
        ],
        'respuestas'    => [
            'respuesta',
            'belongsTo' => [
                'preguntas' => [
                    'label' => 'Pregunta',
                    'column' => 'pregunta_id',
                    'foreignLabel' => 'pregunta',
                ]
            ],
        ],
    ],

    'validationRules' => [
        'users'         => [
            'name'  => 'required|string',
            'email' => 'required|email',
        ],
        'propuestas'    => [
            'nombre'        => 'required|string',
            'contenidos'    => 'string',
            'thumbnail'     => 'string',
            'curso'         => 'required|int|min:1|max:3',
            'archivo'       => 'string',
        ],
        'preguntas'     => [
            'pregunta'  => 'required|string',
            'practica'  => 'boolean',
            'nivel'     => 'required|int|min:1',
        ],
        'respuestas'    => [
            'respuesta' => 'required|string',
        ],
    ]
];
