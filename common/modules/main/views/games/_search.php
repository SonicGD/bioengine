<?php

use bioengine\common\modules\main\models\search\GameSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model GameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-search">

    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get',
        ]
    ); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_old') ?>

    <?= $form->field($model, 'developer_id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'admin_title') ?>

    <?php // echo $form->field($model, 'genre') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'platforms') ?>

    <?php // echo $form->field($model, 'dev') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'publisher') ?>

    <?php // echo $form->field($model, 'localizator') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'small_logo') ?>

    <?php // echo $form->field($model, 'status_old') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'tweettag') ?>

    <?php // echo $form->field($model, 'news_desc') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'specs') ?>

    <?php // echo $form->field($model, 'ozon') ?>

    <?php // echo $form->field($model, 'rate_pos') ?>

    <?php // echo $form->field($model, 'rate_neg') ?>

    <?php // echo $form->field($model, 'voted_users') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
