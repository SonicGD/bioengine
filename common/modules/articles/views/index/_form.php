<?php

use bioengine\common\modules\articles\models\Article;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var             $this yii\web\View
 * @var             $model Article
 * @var             $form yii\widgets\ActiveForm
 *
 * @var Game[]      $games
 * @var Developer[] $developers
 * @var Topic[]     $topics
 */


// The controller action that will render the list
$url = \yii\helpers\Url::to(['cat-list']);
$script = <<<EOF
 var returnUrl = function () {
        return getUrl();
    };
EOF;
$this->registerJs($script, View::POS_HEAD);
$script = <<<EOF
    gameSelect=$('#article-game_id');
    developerSelect=$('#article-developer_id');
    topicSelect=$('#article-topic_id');
    catSelect=$('#article-cat_id');
EOF;
$this->registerJs($script, View::POS_END);
?>
<script type="text/javascript">

    var gameSelect;
    var developerSelect;
    var topicSelect;
    var catSelect;
    var baseUrl = '<?=$url?>';
    function getUrl() {

        var gameId = gameSelect.val();
        var developerId = developerSelect.val();
        var topicId = topicSelect.val();
        return baseUrl + "?gameId=" + gameId + "&developerId=" + developerId + "&topicId=" + topicId;
    }

    var inChange = false;
    function selectType(type) {
        if (inChange) return;
        inChange = true;
        var value = false;
        switch (type) {
            case 'game':
                developerSelect.val(0).trigger("change");
                topicSelect.val(0).trigger("change");
                value = gameSelect.val();
                break;
            case 'developer':
                gameSelect.val(0).trigger("change");
                topicSelect.val(0).trigger("change");
                value = developerSelect.val();
                break;
            case 'topic':
                developerSelect.val(0).trigger("change");
                gameSelect.val(0).trigger("change");
                value = topicSelect.val();
                break;
        }
        catSelect.select2("val", "");
        if (value > 0) {
            catSelect.removeAttr('disabled');
        }
        else {
            catSelect.attr('disabled', 'disabled');
        }
        inChange = false;
    }
    function getData(callback) {
        var id = catSelect.val();
        var url = getUrl();

        var data = {
            catId: id
        };

        $.post(url, data, function (results) {
            callback(results);
        }, 'json');


    }
</script>
<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'game_id')->widget(Select2::classname(), [
                        'data'          => array_merge(['' => ''], $games),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Игра'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            'change' => 'function() { selectType("game"); }'
                        ]

                    ]) ?>

                    <?= $form->field($model, 'developer_id')->widget(Select2::classname(), [
                        'data'          => array_merge(['' => ''], $developers),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Разработчик'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            'change' => 'function() { selectType("developer"); }'
                        ]
                    ]) ?>

                    <?= $form->field($model, 'topic_id')->widget(Select2::classname(), [
                        'data'          => array_merge(['' => ''], $topics),
                        'language'      => 'ru',
                        'options'       => ['placeholder' => 'Тема'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents'  => [
                            'change' => 'function() { selectType("topic"); }'
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
                        'options'       => ['placeholder' => 'Выберите категорию', 'disabled' => $model->isNewRecord],
                        'pluginOptions' => [
                            'allowClear'    => true,
                            //'query'              => new JsExpression('function(query){getData(query);}'),
                            'ajax'          => [
                                'url'      => new JsExpression('returnUrl'),
                                'dataType' => 'json',
                                'data'     => new JsExpression('function(term,page) { return {search:term}; }'),
                                'results'  => new JsExpression('function(data,page) { return {results:data.results}; }')
                            ],
                            'initSelection' => new JsExpression('function(element, callback) { getData(callback); }')
                        ]

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
