<?php

use bioengine\common\modules\main\models\Game;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'developer_id')->textInput() ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'localizator')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'news_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'specs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ozon')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rate_pos')->textInput() ?>

    <?= $form->field($model, 'rate_neg')->textInput() ?>

    <?= $form->field($model, 'voted_users')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'id_old')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'release_date')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'platforms')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'small_logo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status_old')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tweettag')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'admin_title')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'genre')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'dev')->textInput(['maxlength' => 40]) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
