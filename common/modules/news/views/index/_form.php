<?php

use bioengine\common\modules\news\models\News;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model News */
/* @var $form yii\widgets\ActiveForm */

?>
<script type="text/javascript">
    var inChange = false;
    function selectType(type) {
        if (inChange) return;
        inChange = true;
        switch (type) {
            case 'game':
                $('#news-developer_id').val(0).trigger("change");
                $('#news-topic_id').val(0).trigger("change");
                break;
            case 'developer':
                $('#news-game_id').val(0).trigger("change");
                $('#news-topic_id').val(0).trigger("change");
                break;
            case 'topic':
                $('#news-developer_id').val(0).trigger("change");
                $('#news-game_id').val(0).trigger("change");
                break;
        }
        inChange = false;
    }
    function setAddGames() {
        $('input[name="News[addgames]"]').val(JSON.stringify($('select[name="addgames_select[]"]').val()));
    }
</script>
<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4"> <?= $form->field($model, 'game_id')->widget(Select2::classname(), [
                'data'          => array_merge(["" => ""], $games),
                'language'      => 'ru',
                'options'       => ['placeholder' => 'Игра'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents'  => [
                    "change" => 'function() { selectType("game"); }',
                ]

            ]) ?></div>
        <div class="col-lg-4"> <?= $form->field($model, 'developer_id')->widget(Select2::classname(), [
                'data'          => array_merge(["" => ""], $developers),
                'language'      => 'ru',
                'options'       => ['placeholder' => 'Разработчик'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents'  => [
                    "change" => 'function() { selectType("developer"); }',
                ]
            ]) ?></div>
        <div class="col-lg-4"><?= $form->field($model, 'topic_id')->widget(Select2::classname(), [
                'data'          => array_merge(["" => ""], $topics),
                'language'      => 'ru',
                'options'       => ['placeholder' => 'Тема'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents'  => [
                    "change" => 'function() { selectType("topic"); }',
                ]
            ]) ?></div>
    </div>

    <div class="row">
        <div class="col-lg-4"><?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?></div>
        <div class="col-lg-4"><?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?></div>
        <div class="col-lg-4"><?= $form->field($model, 'source')->textInput(['maxlength' => 255]) ?></div>
    </div>










    <?= $form->field($model, 'short_text')->widget(
        \dosamigos\ckeditor\CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset'  => 'standard'
        ]
    ) ?>

    <?= $form->field($model, 'add_text')->widget(
        \dosamigos\ckeditor\CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset'  => 'standard'
        ]
    ) ?>

    <?= $form->field($model, 'addgames')->hiddenInput() ?>
    <?=
    Select2::widget([
        'name'          => 'addgames_select',
        'data'          => array_merge(["" => ""], $games),
        'language'      => 'ru',
        'options'       => ['placeholder' => 'Игра', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,

        ],
        'pluginEvents'  => [
            "change" => 'function() { setAddGames() }',
        ]
    ]);
    ?>


    <?= $form->field($model, 'sticky')->checkbox() ?>

    <?= $form->field($model, 'pub')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
