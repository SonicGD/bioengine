<?php

return [
    '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>/<articleUrl:\w+>' => '/articles/show',
    [
        'pattern'      => '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/articles/cat',
        'encodeParams' => false
    ]
];