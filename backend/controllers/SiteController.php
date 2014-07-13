<?php
namespace bioengine\backend\controllers;

use bioengine\common\modules\ipb\models\IpbPost;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        IpbPost::find()->all();
        return $this->render('index');
    }
}
