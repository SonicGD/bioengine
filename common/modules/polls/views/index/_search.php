<?php

use bioengine\common\modules\polls\models\search\PollSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model PollSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poll-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'poll_id') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'startdate') ?>

    <?= $form->field($model, 'options') ?>

    <?= $form->field($model, 'votes') ?>

    <?php // echo $form->field($model, 'num_choices') ?>

    <?php // echo $form->field($model, 'multiple') ?>

    <?php // echo $form->field($model, 'onoff') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
