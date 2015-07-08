<?php

return [
    [
        'pattern'      => '/<parentUrl:\w+>/news/page/<page:\d+>',
        'route'        => '/site/root',
        'encodeParams' => false
    ],
    [
        'pattern'      => '/<parentUrl:\w+>/news',
        'route'        => '/site/root',
        'encodeParams' => false
    ],
    '/<year:\d+>/<month:\d+>/<day:\d+>/<newsUrl:\w+>' => '/news/show',
    '/page/<page:\d+>'                                => '/site/index',
    '/rss'                                            => 'news/rss'
];