<?php

return [
    [
        'pattern'      => '/<parentUrl:\w+>/gallery/<catUrl:[a-z0-9_\/]+>',
        'route'        => '/gallery/cat',
        'encodeParams' => false
    ]
];