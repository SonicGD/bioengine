<?php

return [
    [
        'pattern'      => '/<parentUrl:\w+>/news',
        'route'        => '/news/root',
        'encodeParams' => false
    ],
    '/<year:\d+>/<month:\d+>/<day:\d+>/<newsUrl:\w+>' => '/news/show',
    '/page/<page:\d+>'                                => '/site/index'
];