<?php

declare(strict_types = 1);

use App\Actions\VerifyMenu;
use App\Models\User;

use function Pest\Laravel\actingAs;

describe('Actions/VerifyMenu -> Feature', function () {
    beforeEach(function () {
        actingAs(User::factory()->make());
    });

    it('returns the same menu when no permissions are set', function () {
        $menu = [
            [
                'submenu' => [
                    ['b'],
                    ['c'],
                ],
                'a',
            ],
        ];

        $response = app(VerifyMenu::class, [
            'user' => User::factory()->make(),
        ])->handle($menu);

        expect($response)->toBeArray()
            ->toBe($menu);
    });

    it('filters out menu items based on permissions', function () {
        $menu = [
            [
                'a',
            ],
            [
                'b',
                'permission' => ['user1', User::class],
            ],
        ];

        $response = app(VerifyMenu::class, [
            'user' => User::factory()->make(),
        ])->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'a',
                ],
            ]);
    });

    it('handles submenu items correctly', function () {
        $menu = [
            [
                'a',
            ],
            [
                'b',
                'submenu' => [
                    'c',
                ],
            ],
        ];

        $response = app(VerifyMenu::class, [
            'user' => User::factory()->make(),
        ])->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'a',
                ],
                [
                    'submenu' => [
                        'c',
                    ],
                    'b',
                ],
            ]);
    });

    it('filters out submenu items based on permissions', function () {
        $menu = [
            [
                'a',
            ],
            [
                'b',
                'submenu' => [
                    'c',
                    ['d', 'permission' => ['user1', User::class]],
                    'd',
                ],
            ],
        ];

        $response = app(VerifyMenu::class, [
            'user' => User::factory()->make(),
        ])->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'a',
                ],
                [
                    'submenu' => [
                        'c',
                        'd',
                    ],
                    'b',
                ],
            ]);
    });

    it('filters out all submenu items based on permissions', function () {
        $menu = [
            [
                'a',
            ],
            [
                'b',
                'submenu' => [
                    ['a', 'permission' => ['user1', User::class]],
                    ['b', 'permission' => ['user1', User::class]],
                    ['c', 'permission' => ['user1', User::class]],
                ],
            ],
        ];

        $response = app(VerifyMenu::class, [
            'user' => User::factory()->make(),
        ])->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'a',
                ],
            ]);
    });

    it('marks the correct menu item as open based on the route', function () {
        Route::get('__testing')->name('test.testing');
        Route::get('__testing_2')->name('test.testing_2');

        $menu = [
            [
                'title' => 'oi',
                'route' => 'test.testing',
            ],
            [
                'title' => 'oi',
                'route' => 'test.testing_2',
            ],
        ];

        $response = (new VerifyMenu(User::factory()->make(), 'test.testing_2'))->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'title' => 'oi',
                    'route' => 'test.testing',
                ],
                [
                    'title' => 'oi',
                    'route' => 'test.testing_2',
                    'open'  => true,
                ],
            ]);
    });

    it('marks the correct submenu item and parent as open based on the route', function () {
        Route::get('__testing')->name('test.testing');
        Route::get('__testing_2')->name('test.testing_2');

        $menu = [
            [
                'title'   => 'oi',
                'submenu' => [
                    [
                        'title' => 'oi',
                        'route' => 'test.testing',
                    ],
                    [
                        'title' => 'oi',
                        'route' => 'test.testing_2',
                    ],
                ],
            ],
        ];

        $response = (new VerifyMenu(User::factory()->make(), 'test.testing_2'))->handle($menu);

        expect($response)->toBeArray()
            ->toBe([
                [
                    'submenu' => [
                        [
                            'title' => 'oi',
                            'route' => 'test.testing',
                        ],
                        [
                            'title' => 'oi',
                            'route' => 'test.testing_2',
                            'open'  => true,
                        ],
                    ],
                    'title' => 'oi',
                    'open'  => true,
                ],
            ]);
    });
});
