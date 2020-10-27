<?php

use BRCas\User\Http\Controller\UserController;
use BRCas\User\Services\UserService;
use BRCas\User\Form\UserForm;

return [
    "controllers" => [
        "users" => UserController::class,
    ],
    "services" => [
        "user" => UserService::class,
    ],
    "forms" => [
        "user" => UserForm::class,
    ],
    "layout" => "layouts.app",
    "tables" => [
        "user" => [
            'Name' => ['field' => 'name'],
            'Email' => ['field' => 'email'],
        ],
    ],
    "filters" => [
        "user" => [
            'filter_name' => 'Name',
            'equal_email' => 'E-mail',
        ],
    ],
    "views" => [
        "users" => [
            "index" => "user::user.index",
            "edit" => "user::user.edit",
            "create" => "user::user.create",
            "show" => "user::user.show",
        ]
    ],
    "permissions" => [
        "_user" => [
            "index" =>  null,
            "edit" => null,
            "create" => null,
            "delete" => null,
        ],
        "user" => [
            "index" => 'user -> index',
            "edit" => 'user -> edit',
            "create" => 'user -> create',
            "delete" => 'user -> delete',
        ]
    ]
];
