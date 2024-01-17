<?php

return [
    "core"=>[
        'route' => [
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['web', 'auth'],
        ],
    ]
];
