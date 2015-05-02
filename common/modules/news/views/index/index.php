<?php

use bioengine\common\modules\news\models\News;
use bioengine\common\modules\news\models\search\NewsSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить новость',
                [
                    'modelClass' => 'News',
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
                'id',
                'title',
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'ParentTitle',
                    'label'     => 'Раздел',
                    'format'    => 'html',
                    'value'     => function (News $data) {
                        return Html::a($data->getParentTitle(), $data->getParentListUrl());
                    }
                ],
                [
                    'attribute' => 'author.name',
                    'label'     => 'Автор',
                    'format'    => 'html',
                    'value'     => function (News $data) {
                        return Html::a($data->author->members_display_name, $data->getAuthorListUrl());
                    }
                ],
                'date:datetime',
                'last_change_date:datetime',
                [
                    'attribute' => 'pub',
                    'label'     => 'Опубликовано',
                    'format'    => 'raw',
                    'value'     => function (News $data) {
                        return $data->pub ? 'Да' : 'Нет';
                    }
                ],
                [
                    'attribute' => 'sticky',
                    'label'     => 'Важная',
                    'format'    => 'raw',
                    'value'     => function (News $data) {
                        return $data->sticky ? 'Да' : 'Нет';
                    }
                ],
                // 'source',
                // 'game_old',

                // 'short_text:ntext',
                // 'add_text:ntext',
                // 'author_id',
                // 'tid',
                // 'pid',
                // 'sticky',
                // 'date',
                // 'last_change_date',
                // 'pub',
                // 'addgames',
                // 'rate_pos',
                // 'rate_neg',
                // 'voted_users:ntext',
                // 'comments',
                // 'twitter_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
