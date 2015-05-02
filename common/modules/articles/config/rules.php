<?php

return [
    '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>/<articleUrl:\w+>' => '/articles/index/show',
    [
        'pattern'      => '/<parentUrl:\w+>/articles/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/articles/index/cat',
        'encodeParams' => false
    ]
];