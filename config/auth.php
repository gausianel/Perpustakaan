<?php

return [

    'defaults' => [
        'guard' => 'web',           // ✅ default untuk login User biasa
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'librarian' => [            // ✅ guard untuk login sebagai librarian
            'driver' => 'session',
            'provider' => 'librarians',
        ],
    ],

    'providers' => [
        'users' => [                // ✅ provider User biasa
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'librarians' => [           // ✅ provider untuk Librarian
            'driver' => 'eloquent',
            'model' => App\Models\Librarian::class,
        ],
    ],

    'passwords' => [
        'users' => [                // Reset password user biasa
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'librarians' => [          // Reset password librarian
            'provider' => 'librarians',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
