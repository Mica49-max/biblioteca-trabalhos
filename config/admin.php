<?php

return [
    // Endereço secreto da área privada (sem barra no início)
    'path' => env('ADMIN_PATH'),

    // Credenciais (a palavra-passe fica guardada como hash)
    'username' => env('ADMIN_USERNAME'),
    'password_hash' => env('ADMIN_PASSWORD_HASH'),
];