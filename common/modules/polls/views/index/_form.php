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
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'question')->textInput(['maxlength' => 200]) ?>
                    <?= $form->field($model, 'onoff')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'multiple')->checkbox() ?>
                    <?= $form->field($model, 'num_choices')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'optionsEdit')->textarea(['rows' => 12]) ?>


    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
