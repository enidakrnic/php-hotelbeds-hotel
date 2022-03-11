<?php

return [
    'api_key' => env('HOTELBEDS_HOTEL_API_KEY', 'API_KEY'),
    'environment' => env('HOTELBEDS_HOTEL_ENVIRONMENT', 'test'),
    'language' => [
        'codes' => [
            'ENG',
            'IND'
        ]
    ],
    'secret' => env('HOTELBEDS_HOTEL_SECRET', 'SECRET'),
    'table_names' => [
        'accommodation' => 'accommodation',
        'accommodations' => 'accommodations',
        'board' => 'board',
        'boards' => 'boards',
        'category' => 'category',
        'categories' => 'categories',
        'description' => 'description',
        'descriptions' => 'descriptions',
        'language' => 'language',
        'languages' => 'languages'
    ]
];
