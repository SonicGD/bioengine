<?php
namespace bioengine\backend\controllers;

use bioengine\common\components\BackendController;
use bioengine\common\modules\ipb\models\IpbPost;

/**
 * Site controller
 */
class SiteController extends BackendController
{
    public function actionIndex()
    {
        IpbPost::find()->all();

        return $this->render('index');
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }
}
