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
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'Individual',
                    'roles' => [User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
                    'page' => 'api.appointments.index',
                ],
                [
                    'title' => 'Family',
                    'roles' => [User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
                    'page' => 'api.family-appointments.index',
                ],
                [
                    'title' => 'All Appointments',
                    'roles' => [User::CLIENT_ROLE],
                    'page' => 'appointments.index',
                ],
            ],
        ],
        [
            'title' => 'Patients',
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>[User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE],
            'submenu' => [
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'users.index'
                ]
            ]
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
