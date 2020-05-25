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
            'section' => 'System',
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
        ],
        [
            'title' => 'Pages',
            'icon' => 'media/svg/icons/Shopping/Barcode-read.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Wizard',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'Wizard 1',
//                            'page' => 'custom/pages/wizard/wizard-1',
//                            'new-tab' => false
                        ],
                    ]
                ],
                [
                    'title' => 'User Pages',
                    'bullet' => 'dot',
                    'label' => [
                        'type' => 'label-rounded label-primary',
                        'value' => '2'
                    ]
                ]
            ]
        ],
    ]

];
