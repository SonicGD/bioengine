<?php

use bioengine\common\modules\main\models\Developer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Developer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="developer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'logo')->fileInput() ?>

                    <?= $form->field($model, 'found_year')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'peoples')->textarea(['rows' => 4]) ?>

                    <?= $form->field($model, 'site')->textInput(['maxlength' => 255]) ?>





                    <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'info')->widget(
                        \dosamigos\ckeditor\CKEditor::className(),
                        [
                            'options' => ['rows' => 6],
                            'preset'  => 'standard'
                        ]
                    ) ?>

                    <?= $form->field($model, 'desc')->widget(
                        \dosamigos\ckeditor\CKEditor::className(),
                        [
                            'options' => ['rows' => 6],
                            'preset'  => 'standard'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
