<?php

return [
    "controllers" => [
        "users" => \BRCas\User\Http\Controller\UserController::class,
    ],
    "services" => [
        "user" => \App\Services\UserService::class,
    ],
    "forms" => [
        "user" => \App\Forms\UserForm::class,
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
        "user" => [
            "index" =>  "Usuário | Relatório",
            "edit" => "Usuário | Edição",
            "create" => "Usuário | Cadastro",
            "delete" => "Usuário | Excluir",
        ]
    ]
];
