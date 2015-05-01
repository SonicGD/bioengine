<?php

use bioengine\common\modules\main\models\Game;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'developer_id')->widget(Select2::classname(), [
                        'data'          => array_merge(["" => ""], $developers),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Разработчик'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ]) ?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'publisher')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'localizator')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'release_date')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'platforms')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'genre')->textInput(['maxlength' => 20]) ?>

                    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                        'options'       => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'initialPreview'   => $model->logo ? [
                                Html::img($model->bigLogoUrl,
                                    ['class' => 'file-preview-image', 'alt' => 'logo', 'title' => 'logo']),
                            ] : '',
                            'initialCaption'   => "logo",
                            'overwriteInitial' => true
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'admin_title')->textInput(['maxlength' => 8]) ?>

                    <?= $form->field($model, 'tweettag')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'small_logo')->widget(FileInput::classname(), [
                        'options'       => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'initialPreview'   => $model->small_logo ? [
                                Html::img($model->smallLogoUrl,
                                    [
                                        'class' => 'file-preview-image',
                                        'alt'   => 'small logo',
                                        'title' => 'small logo'
                                    ])
                            ] : '',
                            'initialCaption'   => "Small logo",
                            'overwriteInitial' => true
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'desc')->widget(
        \dosamigos\ckeditor\CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset'  => 'standard'
        ]
    ) ?>
    <?= $form->field($model, 'news_desc')->widget(
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
