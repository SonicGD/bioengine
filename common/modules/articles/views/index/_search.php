<?php

use bioengine\modules\articles\models\search\ArticleSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'source') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'game_id') ?>

    <?php // echo $form->field($model, 'developer_id') ?>

    <?php // echo $form->field($model, 'topic_id') ?>

    <?php // echo $form->field($model, 'game_old') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'announce') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'pub') ?>

    <?php // echo $form->field($model, 'fs') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
