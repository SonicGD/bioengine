<?php
/**
 * Created by PhpStorm.
 * User: sonic
 * Date: 2/1/15
 * Time: 3:47 PM
 */

namespace bioengine\backend\controllers;


use bioengine\backend\models\LoginForm;
use yii\filters\VerbFilter;
use yii\web\Controller;

class LoginController extends Controller
{
    public $layout = 'login';

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}