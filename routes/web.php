<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\HomeController;
use App\Controllers\StudentController;

return [
    'get::' => [
        'controller' => HomeController::class,
        'method'     => 'index',
    ],
    'get::login' => [
        'controller' => LoginController::class,
        'method'     => 'getForm',
    ],
    'post::login' => [
        'controller' => LoginController::class,
        'method'     => 'login',
    ],
    'post::logout' => [
        'controller' => LoginController::class,
        'method'     => 'logout',
    ],
    'get::register' => [
        'controller' => RegisterController::class,
        'method'     => 'getForm',
    ],
    'post::register' => [
        'controller' => RegisterController::class,
        'method'     => 'register',
    ],
    'get::students/:id' => [
        'controller' => StudentController::class,
        'method'     => 'getStudentResult',
        'params'     => [
            'id' => 'number'
        ]
    ],
];
