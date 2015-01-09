<?php

use bioengine\common\modules\articles\models\Article;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $form yii\widgets\ActiveForm */

// The controller action that will render the list
$url = \yii\helpers\Url::to(['cat-list']);
$script = <<<EOF
 var returnUrl = function () {
        return getUrl();
    };
EOF;
$this->registerJs($script, View::POS_HEAD);
?>
<script type="text/javascript">

    var baseUrl = '<?=$url?>';
    function getUrl() {
        var id = $('#article-cat-id').val();
        var gameId = $('#article-game_id').val();
        var developerId = $('#article-developer_id').val();
        var topicId = $('#article-topic_id').val();
        return baseUrl + "?id=" + id + "&gameId=" + gameId + "&developerId=" + developerId + "&topicId=" + topicId;
    }

    var inChange = false;
    function selectType(type) {
        if (inChange) return;
        inChange = true;
        var value = false;
        switch (type) {
            case 'game':
                $('#article-developer_id').val(0).trigger("change");
                $('#article-topic_id').val(0).trigger("change");
                value = $('#article-game_id').val();
                break;
            case 'developer':
                $('#article-game_id').val(0).trigger("change");
                $('#article-topic_id').val(0).trigger("change");
                value = $('#article-developer_id').val();
                break;
            case 'topic':
                $('#article-developer_id').val(0).trigger("change");
                $('#article-game_id').val(0).trigger("change");
                value = $('#article-topic_id').val();
                break;
        }
        $('#article-cat_id').select2("val", "");
        if (value > 0) {
            $('#article-cat_id').removeAttr('disabled');
        }
        else {
            $('#article-cat_id').attr('disabled', 'disabled');
        }
        inChange = false;
    }
    function getData(query) {

        var url = getUrl();

        var data = {
            query: query.term,
            page: query.page
        };

        $.post(url, data, function (results) {
            query.callback(results);
        });


    }
</script>
<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'game_id')->widget(Select2::classname(), [
                        'data'          => array_merge(["" => ""], $games),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Игра'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            "change" => 'function() { selectType("game"); }',
                        ]

                    ]) ?>

                    <?= $form->field($model, 'developer_id')->widget(Select2::classname(), [
                        'data'          => array_merge(["" => ""], $developers),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Разработчик'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            "change" => 'function() { selectType("developer"); }',
                        ]
                    ]) ?>

                    <?= $form->field($model, 'topic_id')->widget(Select2::classname(), [
                        'data'          => array_merge(["" => ""], $topics),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Тема'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            "change" => 'function() { selectType("topic"); }',
                        ]
                    ]) ?>

                    <?= $form->field($model, 'pub')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">

                    <?= $form->field($model, 'title')->textInput(['maxlength' => 150]) ?>

                    <?= $form->field($model, 'cat_id')->widget(Select2::classname(), [
                        'options'       => ['placeholder' => 'Выберите раздел', 'disabled' => $model->isNewRecord],
                        'pluginOptions' => [
                            'allowClear'    => true,
                            //'query'              => new JsExpression('function(query){getData(query);}'),
                            'ajax'          => [
                                'url'      => new JsExpression('returnUrl'),
                                'dataType' => 'json',
                                'data'     => new JsExpression('function(term,page) { return {search:term}; }'),
                                'results'  => new JsExpression('function(data,page) { return {results:data.results}; }'),
                            ],
                            'initSelection' => new JsExpression('function(element, callback) { return 0; }')
                        ],

                    ]) ?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'source')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>
        </div>

    </div>

    <?= $form->field($model, 'announce')->widget(
        \dosamigos\ckeditor\CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset'  => 'standard'
        ]
    ) ?>

    <?= $form->field($model, 'text')->widget(
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
