<?php

return [
    'prefix' => 'admin',

    'authMiddleware' => 'auth',

    'tables' => ['users', 'propuestas'],

    'rowsPerPage' => 15,

    'additionalLinks' => [],

    'columns' => ['users' => [ 'id', 'name', 'email', 'created_at' ],],

    'filters' => [
        'users' =>
            [
                'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                    'compare' => 'LIKE',
                ],
                'name' => [
                    'label' => 'Nombre',
                    'type' => 'text',
                    'compare' => 'LIKE',
                ],
            ],
    ],
    'forms' => [
        'users' => [
            'name',
            'email',
        ],
        'propuestas' => [
            'nombre',
            'contenidos',
            'thumbnail',
            'archivo',
        ],
    ],

    'validationRules' => [
        'users' => [
            'name' => 'required|string',
            'email' => 'required|email',
        ],
        'propuestas' => [
            'nombre' => 'required|string',
            'contenidos' => 'required|string',
            'thumbnail' => 'string',
            'archivo' => 'string',
        ],
    ]
];
