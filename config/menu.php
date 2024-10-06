<?php

declare(strict_types = 1);

return [
    [
        'title' => 'Dashboard',
        'route' => 'dashboard',
    ],
    [
        'title'   => 'Admin',
        'submenu' => [
            [
                'title'      => 'User',
                'route'      => 'admin.user',
                'permission' => ['viewAny', 'App\Models\User'],
            ],
        ],
    ],
];
