<?php
/**
 * @var ActiveForm $form
 * @var LoginForm  $model
 */
use bioengine\backend\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="form-box" id="login-box">
    <div class="header">BioEngine</div>
    <?php $form = ActiveForm::begin([
        'id'          => 'login-form',
        'fieldConfig' => [
            'template' => "{input}\n<div>{error}</div>"
        ]
    ]); ?>
    <div class="body bg-gray">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
    <div class="footer">

        <?= Html::submitButton('Войти', ['class' => 'btn bg-primary btn-block', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>