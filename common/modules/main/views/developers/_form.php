<?php

use bioengine\common\modules\main\models\Developer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Developer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="developer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'peoples')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'voted_users')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'found_year')->textInput() ?>

    <?= $form->field($model, 'rate_pos')->textInput() ?>

    <?= $form->field($model, 'rate_neg')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
