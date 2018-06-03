<?php

$ROUTES = [
    '/' => '/controllers/DeviceController@show',

    '/login'                => '/controllers/LoginController@index',
    '/login/recuperarSenha' => '/controllers/LoginController@recuperarSenha',
    '/login/cadastrar'      => '/controllers/LoginController@cadastroNovo',
    '/login/cadastrado'     => '/controllers/LoginController@cadastroSalvo',
    '/login/usuarios'       => '/controllers/LoginController@usuarios',

    '/dispositivos'         => '/controllers/DeviceController@show',
    '/dispositivos/criar'   => '/controllers/DeviceController@create',
    '/dispositivos/editar'  => '/controllers/DeviceController@update',
    '/dispositivos/remover' => '/controllers/DeviceController@delete',

    '/criptografador' => '/controllers/EncryptController@encryptDecrypt',
    '/calc-hash'      => '/controllers/EncryptController@hashCalc',

    '/errors/notfound' => '/errors/NotFound',

];
