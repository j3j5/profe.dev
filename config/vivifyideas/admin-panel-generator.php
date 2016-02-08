<?php

return [
    'prefix' => 'admin',

    'authMiddleware' => 'auth',

    'tables' => ['users', 'propuestas', 'preguntas', 'respuestas'],

    'rowsPerPage' => 15,

    'additionalLinks' => [],

    'columns'   => [
        'users'         => ['id', 'name', 'email', 'created_at'],
        'propuestas'    => ['nombre', 'contenidos', 'thumbnail', 'archivo', 'updated_at',],
        'preguntas'     => ['pregunta', 'practica', 'updated_at'],
        'respuestas'     => ['respuesta', 'updated_at'],
    ],

    'filters' => [
        'users'     =>
            [
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
        'preguntas' =>
            [
                'practica' => [
                    'label' => '¿Es de práctica?',
                    'type'  => 'checkbox',
                ],
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
            'thumbnail',
            'archivo',
        ],
        'preguntas'     => [
            'pregunta',
            'practica' => [
                'label' => '¿Es de prácticas?',
                'type' => 'checkbox',
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
            'contenidos'    => 'required|string',
            'thumbnail'     => 'string',
            'archivo'       => 'string',
        ],
        'preguntas'     => [
            'pregunta'  => 'required|string',
            'practica'  => 'boolean',
        ],
        'respuestas'    => [
            'respuesta' => 'required|string',
        ],
    ]
];
