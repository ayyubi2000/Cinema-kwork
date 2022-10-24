<?php

return [
    'super_admin' => [
        'user' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
            'roles',
            'updateYourself',
            'checkUserToken'
        ],
        'country' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'category' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'studio-news' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'genre' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'studio' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'movie' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'awards-photos' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'serie' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'movie-new' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ],
        'upload-file' => [
            'index',
        ],
        'movie-new-comentary' => [
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ]
    ],
    'editor' => [
        'user' => [
            'updateYourself',
            'checkUserToken'
        ],
    ],
    'moderator' => [
        'user' => [
            'updateYourself',
            'checkUserToken'
        ],
    ],
    'suspect_user' => [
        'user' => [
            'updateYourself',
            'checkUserToken'
        ],
    ],
    'user' => [
        'user' => [
            'updateYourself',
            'checkUserToken'
        ],
    ],
    'super_user' => [
        'user' => [
            'updateYourself',
            'checkUserToken'
        ],
    ]
];