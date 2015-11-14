<?php

return [
    'prefix' => 'admin',

    'authMiddleware' => 'auth',

    'tables' => ['users'],

    'rowsPerPage' => 15,

    'additionalLinks' => [],

    'columns' => ['users' => [ 'id', 'name', 'email', 'created_at' ],],

    'filters' => ['users' =>
        [
            'email' => [
                'label' => 'Email',
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
    ],

    'validationRules' => [
        'users' => [
            'name' => 'required|string',
            'email' => 'required|email',
        ]
    ]
];
