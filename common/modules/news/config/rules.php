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
    '/<year:\d+>/<month:\d+>/<day:\d+>/<newsUrl:(.)+>'  => '/index/show',
    '/<year:\d+>/<month:\d+>/<day:\d+>/page/<page:\d+>' => '/site/date',
    '/<year:\d+>/<month:\d+>/<day:\d+>'                 => '/site/date',
    '/<year:\d+>/<month:\d+>/page/<page:\d+>'           => '/site/date',
    '/<year:\d+>/<month:\d+>'                           => '/site/date',
    '/<year:\d+>/page/<page:\d+>'                       => '/site/date',
    '/<year:\d+>'                                       => '/site/date',
    '/page/<page:\d+>'                                  => '/site/index',
    '/rss'                                              => 'news/rss',
    'news/update-forum-post'                            => 'news/update-forum-post'
];