<?php

return [
    [
        'pattern'      => '/<parentUrl:\w+>/files',
        'route'        => '/files/root',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/files/<catUrl:[a-z0-9_\/]+>/<fileUrl:[a-z0-9_]+>/download',
        'route'        => '/files/download',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/files/<catUrl:[a-z0-9_\/]+>/<fileUrl:[a-z0-9_]+>',
        'route'        => '/files/show',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/files/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/files/cat',
        'encodeParams' => false
    ]
];