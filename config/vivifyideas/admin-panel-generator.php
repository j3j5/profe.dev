<?php

return [
    'prefix' => 'admin',

    'authMiddleware' => 'auth',

    'tables' => ['propuestas', 'images', 'grupo_conceptos', 'conceptos', 'me_gustas'],

    'rowsPerPage' => 15,

    'additionalLinks' => ['Ver página' => 'HomeController@index'],

    'columns'   => [
        'users'         => ['id', 'name', 'email', 'created_at'],
        'propuestas'    => ['nombre', 'contenidos', 'thumbnail', 'archivo', 'curso', 'updated_at',],
        'images'        => ['titulo', 'artista', 'año', 'curso', 'nombre-archivo', 'updated_at'],
        'conceptos'     => ['palabra', 'definicion', 'curso', 'grupo','thumbnail', 'updated_at'],
        'grupo_conceptos' => ['nombre', 'created_at'],
        'me_gustas'     => ['titulo', 'autor', 'curso', 'imagen', 'featured'],
//         'preguntas'     => ['pregunta', 'practica', 'updated_at'],
//         'respuestas'    => ['respuesta', 'updated_at'],
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
        'images' => [
            'curso' => [
                'label' => 'Curso',
                'type'  => 'number',
            ],
            'año' => [
                'label' => 'Año',
                'type'  => 'number',
            ],
            'artista' => [
                'label'     => 'Artista',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
        ],
        'conceptos' => [
            'palabra' => [
                'label'     => 'Palabra',
                'type'      => 'text',
                'compare'   => 'LIKE',
            ],
            'curso' => [
                'label' => 'Curso',
                'type'  => 'number',
            ],
        ],
        'grupo_conceptos' => [],
        'me_gustas' => [
            'curso' => [
                'label' => 'Curso',
                'type'  => 'number',
            ],
        ],
//         'preguntas' => [
//             'practica'  => [
//                 'label' => '¿Es de práctica?',
//                 'type'  => 'checkbox',
//             ],
//             'nivel'     => [
//                 'label' => 'Nivel',
//                 'type'  => 'text'
//             ],
//         ],
//         'respuestas' => [
// //             'pregunta_id'
//         ],
    ],
    'forms' => [
        'users'         => [
            'name',
            'email',
            'password',
        ],
        'propuestas'    => [
            'nombre' => [
                'label' => "Nombre",
                'type'  => "text",
            ],
            'contenidos' => [
                'label' => "Contenidos de la propuesta",
                'type'  => "text",
            ],
            'curso' => [
                'label' => 'Curso',
                'type' => 'select',
                'dropdown' => ['1' => 'Primero', '2'=> 'Segundo',  '3'=> 'Tercero',],
            ],
            'thumbnail',
            'archivo',
        ],
        'images' => [
            'titulo' => [
                'label' => "Título de la imagen",
                'type'  => "text",
            ],
            'artista' => [
                'label' => "Nombre del artista",
                'type'  => "text",
            ],
            'año' => [
                'label' => "Año en que se realizó la imagen",
                'type'  => "text",
            ],
            'curso' => [
                'label' => 'Curso',
                'type' => 'select',
                'dropdown' => ['1' => 'Primero', '2'=> 'Segundo',  '3'=> 'Tercero',],
            ],
            'nombre-archivo',
        ],
        'conceptos'     => [
            'palabra' => [
                'label' => "Concepto",
                'type'  => "text",
            ],
            'definicion' => [
                'label' => "Definición del concepto",
                'type'  => "textarea",
            ],
            'curso' => [
                'label' => 'Curso',
                'type' => 'select',
                'dropdown' => ['1' => 'Primero', '2'=> 'Segundo',  '3'=> 'Tercero',],
            ],
            'belongsTo' => [
                'grupo_conceptos' => [
                    'label' => 'Grupo de Conceptos',
                    'column' => 'grupo_id',
                    'foreignLabel' => 'nombre',
                ]
            ],
            'thumbnail',
        ],
        'grupo_conceptos' => [
            'nombre',
        ],
        'me_gustas' => [
             'titulo' => [
                'label' => "Título de la imagen",
                'type'  => "text",
            ],
            'autor' => [
                'label' => "Nombre del artista",
                'type'  => "text",
            ],
            'curso' => [
                'label' => 'Curso',
                'type' => 'select',
                'dropdown' => ['1' => 'Primero', '2'=> 'Segundo',  '3'=> 'Tercero',],
            ],
            'featured' => [
                'label' => "¿Mostrar en portada?",
                'type'  => "checkbox",
            ],
            'imagen',
        ],
//         'preguntas'     => [
//             'pregunta',
//             'practica' => [
//                 'label' => '¿Es de prácticas?',
//                 'type' => 'checkbox',
//             ],
//             'nivel' => [
//                 'label' => 'Nivel',
//                 'type' => 'number',
//             ],
//             'hasMany' => [
//                 'respuestas' => [
//                     'label' => 'Respuesta',
//                     'column' => 'id',
//                     'foreignLabel' => 'respuesta'
//                 ]
//             ],
//         ],
//         'respuestas'    => [
//             'respuesta',
//             'belongsTo' => [
//                 'preguntas' => [
//                     'label' => 'Pregunta',
//                     'column' => 'pregunta_id',
//                     'foreignLabel' => 'pregunta',
//                 ]
//             ],
//         ],
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
            'archivo'       => 'required|string',
        ],
        'images' =>  [
            'titulo'    => 'string',
            'artista'   => 'string',
            'año'       => 'int',
            'curso'     => 'required|int|min:1|max:3',
            'nombre-archivo' => 'required|string',
        ],
        'conceptos' => [
            'palabra'       => "required|string",
            'definicion'    => "string",
            'curso'         => "required|int|min:1|max:3",
            'thumbnail'     => "string",
        ],
        'grupo_conceptos' => [
            'nombre'    => 'required|string',
        ],
        'me_gustas' => [
            'titulo'    => 'string',
            'imagen'    => 'required|string',
        ],
//         'preguntas'     => [
//             'pregunta'  => 'required|string',
//             'practica'  => 'boolean',
//             'nivel'     => 'required|int|min:1',
//         ],
//         'respuestas'    => [
//             'respuesta' => 'required|string',
//         ],
    ]
];
