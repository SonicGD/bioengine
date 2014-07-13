<?php

use bioengine\common\modules\polls\models\Poll;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Poll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poll-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'num_choices')->textInput() ?>

    <?= $form->field($model, 'multiple')->textInput() ?>

    <?= $form->field($model, 'onoff')->textInput() ?>

    <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'votes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
