<?php

return [
    '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>/<articleUrl:[a-z0-9_]+>' => '/articles/show',
    [
        'pattern'      => '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/articles/cat',
        'encodeParams' => false
    ]
];