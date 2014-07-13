<?php

use bioengine\common\modules\files\models\search\FileSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model FileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-search">

    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get',
        ]
    ); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'game_old') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'game_id') ?>

    <?php // echo $form->field($model, 'developer_id') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'announce') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'stream') ?>

    <?php // echo $form->field($model, 'streamfile') ?>

    <?php // echo $form->field($model, 'yt_status') ?>

    <?php // echo $form->field($model, 'yt_title') ?>

    <?php // echo $form->field($model, 'yt_url') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
