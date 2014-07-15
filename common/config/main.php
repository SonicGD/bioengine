<?php
return [
    'language'   => 'ru',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n'  => [
            'translations' => [
                'app' => [
                    'class'            => yii\i18n\PhpMessageSource::className(),
                    'basePath'         => '@bioengine/common/messages',
                    'forceTranslation' => true,
                    'sourceLanguage'   => 'ru',
                ],
            ],
        ]
    ],
];
