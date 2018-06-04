<?php

$ROUTES = [
    '/' => '/controllers/DeviceController@show',

    '/dispositivos'         => '/controllers/DeviceController@show',
    '/dispositivos/criar'   => '/controllers/DeviceController@create',
    '/dispositivos/editar'  => '/controllers/DeviceController@update',
    '/dispositivos/remover' => '/controllers/DeviceController@delete',

    '/criptografador' => '/controllers/EncryptController@encryptDecrypt',
    '/calc-hash'      => '/controllers/EncryptController@hashCalc',

    '/terminal'     => '/controllers/terminalController@terminal',
    '/terminal-run' => '/controllers/terminalController@runCommand',

    '/errors/notfound' => '/errors/NotFound',

];
