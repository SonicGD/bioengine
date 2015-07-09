<?php

return [
    '/<parentUrl:\w+>/articles'                                              => '/articles/root',
    '/<parentUrl:\w+>/articles/<catUrl:[a-zA-Z0-9_\/]+>/<articleUrl:[a-zA-Z0-9_-]+>' => '/articles/show',
    [
        'pattern'      => '/<parentUrl:\w+>/articles/<catUrl:[a-zA-Z0-9_\/]+>',
        'route'        => '/articles/cat',
        'encodeParams' => false
    ]
];