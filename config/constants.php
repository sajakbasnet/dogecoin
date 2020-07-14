<?php
return [
    "URL" => env('APP_URL'),
    "APP_DOMAIN" => env('APP_DOMAIN'),
    "APP_PROTOCOL" => env('APP_PROTOCOL', 'https'),
    "PREFIX" => env('PREFIX', 'system'),
    "PAGINATION" => env('PAGINATION',  25),
    "TWOFA" => env('TWOFA', 1),
    "META" =>  [
        "copyright" => "Copyright 2019 E.K. Solutions Pvt. Ltd.",
        "site" => env('APP_BASE_URL'),
        "emails" => ["krishna.maharjan@ekbana.info", "ekbana@info.com"],
        "api" => [
            "version" => 2
        ]
    ],
    "FROM_MAIL" => env('MAIL_FROM_ADDRESS', 'info@ekbana.com'),
    "FROM_NAME" => env('FROM_NAME', 'Ekbana'),
    'DEFAULT_LOCALE' => env('DEFAULT_LOCALE', 'en')
];
