<?php

return [
    'index'          => '/site/index',
    '/<gameUrl:\w+>' => '/games/show',
    '/game/<gameUrl:\w+>' => '/games/show',
];