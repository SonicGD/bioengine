<?php

$config = [
    'id'                  => 'app-backend',
    'name'                => 'BioEngine',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log', 'main', 'news', 'articles', 'gallery', 'files', 'polls'],
    'controllerNamespace' => 'bioengine\backend\controllers',
    'vendorPath'          => dirname(dirname(__DIR__)) . '/vendor',
    'viewPath'            => '@bioengine/backend/views',
    'components'          => [
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'showScriptName'  => false,
            'enablePrettyUrl' => true,
            'suffix'          => '.html',
            'rules'           => [
                //default
                [
                    'pattern' => '<controller:\w+>/<action:\w+>',
                    'route'   => '<controller>/<action>'
                ],
                [
                    'pattern' => '<module:\w+>/<controller:\w+>',
                    'route'   => '<module>/<controller>/index'
                ],
                [
                    'pattern' => '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>',
                    'route'   => '<module>/<controller>/<action>'
                ],
            ]
        ],
        'request'      => [
            'class'               => \yii\web\Request::className(),
            'cookieValidationKey' => 'somesecretvalisadasddationkey',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
    ],
    'modules'             => [
        'gii'      => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['192.168.56.1'],
        ],
        'main'     => [
            'class' => \bioengine\common\modules\main\MainModule::className(),
        ],
        'news'     => [
            'class' => \bioengine\common\modules\news\NewsModule::className(),
        ],
        'articles' => [
            'class' => \bioengine\common\modules\articles\ArticlesModule::className(),
        ],
        'files'    => [
            'class' => \bioengine\common\modules\files\FilesModule::className(),
        ],
        'gallery'  => [
            'class' => \bioengine\common\modules\gallery\GalleryModule::className(),
        ],
        'polls'    => [
            'class' => \bioengine\common\modules\polls\PollsModule::className(),
        ],
    ],
];

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);

