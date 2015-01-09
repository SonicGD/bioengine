<?php

use bioengine\common\modules\main\models\Topic;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Topic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topic-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-primary">
        <div class="box-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                'options'       => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'   => [
                        Html::img($model->logo,
                            ['class' => 'file-preview-image', 'alt' => 'logo', 'title' => 'logo']),
                    ],
                    'initialCaption'   => "logo",
                    'overwriteInitial' => true
                ]
            ]) ?>
        </div>
    </div>
    <?= $form->field($model, 'desc')->widget(
        \dosamigos\ckeditor\CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset'  => 'standard'
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
