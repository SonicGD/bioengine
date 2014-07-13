<?php

use bioengine\common\modules\main\models\search\SiteTeamSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model SiteTeamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-team-search">

    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get',
        ]
    ); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'developers') ?>

    <?= $form->field($model, 'games') ?>

    <?= $form->field($model, 'news') ?>

    <?php // echo $form->field($model, 'articles') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'gallery') ?>

    <?php // echo $form->field($model, 'polls') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
