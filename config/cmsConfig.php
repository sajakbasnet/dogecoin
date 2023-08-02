<?php

$getMethod = 'get';
$postMethod = 'post';
$putMethod = 'put';
$deleteMethod = 'delete';

$homeBaseUrl = '/home';
$userBaseUrl = '/users';
$roleBaseUrl = '/roles';
$loginLogsBaseUrl = '/login-logs';
$activityLogsBaseUrl = '/activity-logs';
// $languagesBaseUrl = '/languages';
// $translationBaseUrl = '/translations';
// $emailTemplateBaseUrl = '/email-templates';
// $configBaseUrl = '/configs';
$profileBaseUrl = '/profile';
$ticketBaseUrl = '/ticket';

return  [
    // routes entered in this array are accessible by any user no matter what role is given
    'permissionGrantedbyDefaultRoutes' => [
        [
            'url' => $homeBaseUrl,
            'method' => $getMethod,
        ],
        [
            'url' => '/logout',
            'method' => $getMethod,
        ],
        [
            'url' => '/languages/set-language/*',
            'method' => $getMethod,
        ],
        [
            'url' => '/miscellaneous/scrap',
            'method' => $getMethod,
        ],
        [
            'url' => $profileBaseUrl,
            'method' => $getMethod,
        ],
        [
            'url' => $profileBaseUrl . '/*',
            'method' => $putMethod,
        ],
        [
            'url' => '/change-password',
            'method' => $getMethod,
        ],
        [
            'url' => '/2fa',
            'method' => $postMethod,
        ],
    ],

    // All the routes are accessible by super user by default
    // routes entered in this array are not accessible by super user
    'permissionDeniedToSuperUserRoutes' => [],

    'modules' => [
        [
            'name' => 'Dashboard',
            'icon' => "<i class='fa fa-home'></i>",
            'hasSubmodules' => false,
            'route' => $homeBaseUrl,
        ],
        [
            'name' => 'User Management',
            'icon' => "<i class='fa fa-user'></i>",
            'hasSubmodules' => true,
            'submodules' => [
                [
                    'name' => 'Users',
                    'icon' => "<i class='fa fa-users'></i>",
                    'hasSubmodules' => false,
                    'route' => $userBaseUrl,
                    'permissions' => [
                        [
                            'name' => 'View Users',
                            'route' => [
                                'url' => $userBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Users',
                            'route' => [
                                'url' => $userBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                        [
                            'name' => 'Reset Password',
                            'route' => [
                                'url' => $userBaseUrl . '/reset-password/*',
                                'method' => $postMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Roles',
                    'icon' => "<i class='fa fa-tags'></i>",
                    'hasSubmodules' => false,
                    'route' => '/roles',
                    'permissions' => [
                        [
                            'name' => 'View Roles',
                            'route' => [
                                'url' => $roleBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Roles',
                            'route' => [
                                'url' => $roleBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        // [
        //     'name' => 'Log Management',
        //     'icon' => "<i class='fa fa-history'></i>",
        //     'hasSubmodules' => true,
        //     'submodules' => [
        //         [
        //             'name' => 'Login Logs',
        //             'icon' => "<i class='fas fa-sign-in-alt'></i>",
        //             'hasSubmodules' => false,
        //             'route' => $loginLogsBaseUrl,
        //             'permissions' => [
        //                 [
        //                     'name' => 'View Login logs',
        //                     'route' => [
        //                         'url' => $loginLogsBaseUrl,
        //                         'method' => $getMethod,
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'name' => 'Activity logs',
        //             'icon' => "<i class='fas fa-chart-line'></i>",
        //             'hasSubmodules' => false,
        //             'route' => $activityLogsBaseUrl,
        //             'permissions' => [
        //                 [
        //                     'name' => 'View Activity logs',
        //                     'route' => [
        //                         'url' => $activityLogsBaseUrl,
        //                         'method' => $getMethod,
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        [
            'name' => 'Tickets',
            'icon' => "<i class='fa fa-ticket'></i>",
            'hasSubmodules' => false,
            'route' => $ticketBaseUrl,
            'permissions' => [
                [
                    'name' => 'View Ticket',
                    'route' => [
                        'url' => $ticketBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Ticket',
                    'route' => [
                        [
                            'url' => $ticketBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $ticketBaseUrl,
                            'method' => $postMethod,
                        ],

                    ],
                ],
                [
                    'name' => 'Edit Ticket',
                    'route' => [
                        [
                            'url' => $ticketBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $ticketBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Ticket',
                    'route' => [
                        'url' => $ticketBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ],
                
               
                        [
                            'name' => 'View Ticket Consult',
                            'route' => [
                                'url' => $ticketBaseUrl . '/*/consult',
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Send Consult Message',
                            'route' => [
                                [
                                    'url' => $ticketBaseUrl . '/*/consult/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $ticketBaseUrl . '/*/consult',
                                    'method' => $postMethod,
                                ],

                            ],
                        ],
                   
            ],
        ],

    ],
];
