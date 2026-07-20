<?php

return [

    'driver' => 'argon',

    'bcrypt' => [
        'rounds' => 12,
    ],

    'argon' => [
        'memory' => 65536,
        'threads' => 2,
        'time' => 4,
        'type' => PASSWORD_ARGON2ID,
    ],

];
