<?php

return [
    'api_key' => env('HOTELBEDS_HOTEL_API_KEY', 'API_KEY'),
    'environment' => env('HOTELBEDS_HOTEL_ENVIRONMENT', 'test'),
    'language' => [
        'codes' => [
            'ENG',
            // 'IND',
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
        'chain' => 'chain',
        'chains' => 'chains',
        'classification' => 'classification',
        'classifications' => 'classifications',
        'currency' => 'currency',
        'currencies' => 'currencies',
        'description' => 'description',
        'descriptions' => 'descriptions',
        'facility' => 'facility',
        'facilities' => 'facilities',
        'language' => 'language',
        'languages' => 'languages'
    ]
];
