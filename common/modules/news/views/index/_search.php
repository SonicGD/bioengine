<?php

use bioengine\common\modules\news\models\search\NewsSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'game_id') ?>

    <?= $form->field($model, 'developer_id') ?>

    <?= $form->field($model, 'topic_id') ?>

    <?= $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'game_old') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'short_text') ?>

    <?php // echo $form->field($model, 'add_text') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'tid') ?>

    <?php // echo $form->field($model, 'pid') ?>

    <?php // echo $form->field($model, 'sticky') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'last_change_date') ?>

    <?php // echo $form->field($model, 'pub') ?>

    <?php // echo $form->field($model, 'addgames') ?>

    <?php // echo $form->field($model, 'rate_pos') ?>

    <?php // echo $form->field($model, 'rate_neg') ?>

    <?php // echo $form->field($model, 'voted_users') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'twitter_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
