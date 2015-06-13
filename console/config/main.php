<?php
$config = [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'console\controllers',
    'modules'             => [],
    'components'          => [
        'log' => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ]
    ]
];

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);