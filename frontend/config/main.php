<?php
define('BIO_ENV', 'frontend');
$config = [
    'id'                  => 'app-frontend',
    'name'                => 'BioEngine',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => [
        'log',
        'mainModule',
        'newsModule',
        'articlesModule',
        'galleryModule',
        'filesModule',
        'pollsModule'
    ],
    'controllerNamespace' => 'bioengine\frontend\controllers',
    'vendorPath'          => dirname(dirname(__DIR__)) . '/vendor',
    'viewPath'            => '@bioengine/frontend/views',
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
                [
                    'class'   => \bioengine\frontend\components\GameRule::class,
                    'pattern' => '<gameUrl:(.)+>',
                    'route'   => 'game/shows'
                ],
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
    ],
    'modules'             => [
        'gii'            => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['192.168.56.1'],
        ],
        'mainModule'     => [
            'class' => \bioengine\common\modules\main\MainModule::className(),
        ],
        'newsModule'     => [
            'class' => \bioengine\common\modules\news\NewsModule::className(),
        ],
        'articlesModule' => [
            'class' => \bioengine\common\modules\articles\ArticlesModule::className(),
        ],
        'filesModule'    => [
            'class' => \bioengine\common\modules\files\FilesModule::className(),
        ],
        'galleryModule'  => [
            'class' => \bioengine\common\modules\gallery\GalleryModule::className(),
        ],
        'pollsModule'    => [
            'class' => \bioengine\common\modules\polls\PollsModule::className(),
        ],
    ],
];

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);

