<?php
namespace bioengine\frontend\controllers;

use bioengine\frontend\components\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
