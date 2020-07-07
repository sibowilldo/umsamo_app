<?php
// Aside menu
use App\User;

return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'dashboard',
            'new-tab' => false,
        ],

        // User
        [
            'section' => 'User',
            'roles'=>['client'],
        ],
        // Admin
        [
            'section' => 'Admin',
            'roles'=>[User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
        ],
        // Appointments
        [
            'title' => 'Appointments',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Clock.svg', // or can be 'flaticon-home' or any flaticon-*
            'bullet' => 'line',
            'submenu' => [
                [
                    'title' => 'Today\'s List',
                    'roles' => [User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
                    'icon' => 'media/svg/icons/Home/Clock.svg',
                    'page' => 'appointments.today',
                ],
                [
                    'title' => 'Upcoming',
                    'roles' => [User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
                    'icon' => 'media/svg/icons/Home/Clock.svg',
                    'page' => 'appointments.upcoming',
                ],
                [
                    'title' => 'Historical',
                    'roles' => [User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
                    'icon' => 'media/svg/icons/Home/Clock.svg',
                    'page' => 'appointments.historical',
                ],
                [
                    'title' => 'My Appointments',
                    'roles' => [User::CLIENT_ROLE],
                    'page' => 'appointments.index',
                ],
                [
                    'title' => 'Family Appointments',
                    'roles' => [User::CLIENT_ROLE],
                    'page' => 'appointments.index',
                ],
            ],
        ],
        // Custom
        [
            'section' => 'System',
            'roles'=>[User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
        ],
        [
            'title' => 'Events',
            'icon' => 'media/svg/icons/Layout/Layout-top-panel-6.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>[User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
            'submenu' => [
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'events.index'
                ],
                [
                    'title' => 'Create New',
                    'bullet' => 'dot',
                    'page' => 'events.create'
                ],
            ]
        ],
        [
            'title' => 'Statuses',
            'icon' => 'media/svg/icons/Shopping/Settings.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>[User::SUPER_ADMIN_ROLE],
            'submenu' => [
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'statuses.index'
                ],
                [
                    'title' => 'Create New',
                    'bullet' => 'dot',
                    'page' => 'statuses.create'
                ],
            ]
        ],
        [
            'title' => 'Regions',
            'icon' => 'media/svg/icons/Map/Compass.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>[User::SUPER_ADMIN_ROLE],
            'submenu' => [
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'regions.index',
                    'label' => [
                        'type' => 'label-light-danger label-inline',
                        'value' => 'new'
                    ]
                ],
                [
                    'title' => 'Create New',
                    'bullet' => 'dot',
                    'page' => 'regions.create'
                ],
            ]
        ]
    ]

];
