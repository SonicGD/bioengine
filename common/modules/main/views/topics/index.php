<?php

use bioengine\common\modules\main\models\search\TopicSearch;
use bioengine\common\modules\main\models\Topic;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel TopicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Темы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить тему',
                [
                    'modelClass' => 'Topic',
                ]
            ),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'url:url',
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'logo',
                    'label'     => 'Лого',
                    'format'    => 'html',
                    'value'     => function (Topic $data) {
                        return $data->logo ? Html::img($data->getLogoUrl()) : 'n/a';
                    }
                ],
                'desc:ntext',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
