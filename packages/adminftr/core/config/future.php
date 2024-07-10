<?php

return [
    'future' => [
        'route' => [
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['web', 'auth'],
        ],
        'messages' => true,
        'notifications' => true,
        'widgets' => [
            \Future\Widgets\Future\Widgets\Widgets::make('demo', 'demo description'),
        ],
    ],
];
