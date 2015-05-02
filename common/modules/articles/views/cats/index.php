<?php

use bioengine\common\modules\articles\models\ArticleCat;
use bioengine\common\modules\articles\models\search\ArticleSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Статьи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить категорию',
                [
                    'modelClass' => 'Article',
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
                'url:url',
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'cat.title',
                    'label'     => 'Родительская категория',
                    'format'    => 'html',
                    'value'     => function (ArticleCat $data) {
                        return $data->parent ? Html::a($data->parent->title, $data->parent->getListUrl()) : 'Нет';
                    }
                ],
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'ParentTitle',
                    'label'     => 'Раздел',
                    'format'    => 'html',
                    'value'     => function (ArticleCat $data) {
                        return Html::a($data->getParentTitle(), $data->getParentListUrl());
                    }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
