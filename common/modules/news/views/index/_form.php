<?php

use bioengine\common\modules\news\models\News;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_id')->dropDownList($games) ?>

    <?= $form->field($model, 'developer_id')->dropDownList($developers) ?>

    <?= $form->field($model, 'topic_id')->widget(TypeaheadBasic::classname(), [
        'data'          => $topics ,
        'pluginOptions' => ['highlight' => true],
        'options'       => ['placeholder' => 'Filter as you type ...'],
    ]) ?>

    <?= $form->field($model, 'sticky')->checkbox() ?>

    <?= $form->field($model, 'pub')->checkbox() ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'short_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'add_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'addgames')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
