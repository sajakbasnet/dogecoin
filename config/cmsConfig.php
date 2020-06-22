<?php

return  [
    // routes entered in this array are accessible by any user no matter what role is given
    'permissionGrantedbyDefaultRoutes' => [
        [
            "url" => '/home',
            "method" => 'get'
        ],
        [
            "url" => '/logout',
            "method" => 'get'
        ],
        [
            "url" => '/languages/set-language',
            "method" => 'get'
        ],
        [
            "url" => '/miscellaneous/scrap',
            "method" => 'get'
        ]

    ],

    // All the routes are accessible by super user by default
    // routes entered in this array are not accessible by super user
    "permissionDeniedToSuperUserRoutes" => [],

    'modules' => [
        [
            'name' => 'Dashboard',
            'icon'=> `<i class='fa fa-home'></i>`,
            'hasSubmodules' => false,
            'route' => '/home'
        ]
    ]
];
