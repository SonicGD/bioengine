<?php

use bioengine\common\modules\gallery\models\search\GalleryPicSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model GalleryPicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-pic-search">

    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get',
        ]
    ); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'game_old') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'game_id') ?>

    <?= $form->field($model, 'developer_id') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'pub') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
