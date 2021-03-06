<?php

return [
    [
        'pattern'      => '/<parentUrl:\w+>/gallery',
        'route'        => '/gallery/root',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/gallery/<catUrl:[a-z0-9_\/]+>/<picId:\d+>',
        'route'        => '/gallery/show',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/gallery/<catUrl:[a-z0-9_\/]+>/show/<fileName:[a-z0-9_-]+>',
        'route'        => '/gallery/show-by-file-name',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/gallery/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/gallery/cat',
        'encodeParams' => false
    ],

    [
        'pattern' => '/gallery/thumb/<picId:\d+>/<width:\d+>/<height:\d+>',
        'route'   => '/gallery/thumb'
    ],
    [
        'pattern'      => '/gallery/thumb/<picId:\d+>/<width:\d+>/<height:\d+>/<picIndex:\d+>',
        'route'        => '/gallery/thumb',
        'encodeParams' => false
    ]
];