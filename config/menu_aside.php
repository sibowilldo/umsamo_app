<?php
// Aside menu
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

        // Custom
        [
            'section' => 'User',
        ],
        // Dashboard
        [
            'title' => 'Appointments',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Clock.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'appointments.index',
            'new-tab' => false,
        ],
        // Custom
        [
            'section' => 'System',
            'roles'=>['administrator', 'kingpin'],
        ],
        [
            'title' => 'Regions',
            'icon' => 'media/svg/icons/Map/Compass.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>['administrator', 'kingpin'],
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
        ],
        [
            'title' => 'Statuses',
            'icon' => 'media/svg/icons/Shopping/Settings.svg',
            'bullet' => 'dot', // dot | line
            'root' => true,
            'roles'=>['administrator', 'kingpin'],
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
        ]
    ]

];
