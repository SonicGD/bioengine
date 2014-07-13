<?php

use bioengine\common\modules\main\models\search\DeveloperSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model DeveloperSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="developer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'info') ?>

    <?= $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'found_year') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'peoples') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'rate_pos') ?>

    <?php // echo $form->field($model, 'rate_neg') ?>

    <?php // echo $form->field($model, 'voted_users') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
