<?php
namespace bioengine\backend\controllers;

use bioengine\backend\components\Controller;
use bioengine\common\models\IpbPost;

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
