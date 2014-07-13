<?php

use bioengine\common\modules\main\models\SiteTeam;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model SiteTeam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'developers')->textInput() ?>

    <?= $form->field($model, 'games')->textInput() ?>

    <?= $form->field($model, 'news')->textInput() ?>

    <?= $form->field($model, 'articles')->textInput() ?>

    <?= $form->field($model, 'files')->textInput() ?>

    <?= $form->field($model, 'gallery')->textInput() ?>

    <?= $form->field($model, 'polls')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
