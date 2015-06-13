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

    public function actionLogin($login, $password)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ['result' => false];
    }
}
