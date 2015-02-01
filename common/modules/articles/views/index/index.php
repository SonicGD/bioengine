<?php

use bioengine\common\modules\articles\models\Article;
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
                'Добавить статью    ',
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
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'cat.title',
                    'label'     => 'Категория',
                    'format'    => 'html',
                    'value'     => function (Article $data) {
                        return Html::a($data->cat->title, $data->cat->getListUrl());
                    }
                ],
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'ParentTitle',
                    'label'     => 'Раздел',
                    'format'    => 'html',
                    'value'     => function (Article $data) {
                        return Html::a($data->getParentTitle(), $data->getParentListUrl());
                    }
                ],
                [
                    'attribute' => 'author.name',
                    'label'     => 'Раздел',
                    'format'    => 'html',
                    'value'     => function (Article $data) {
                        return Html::a($data->author->members_display_name, $data->getAuthorListUrl());
                    }
                ],
                'date:date',
                [
                    'attribute' => 'pub',
                    'label'     => 'Опубликовано',
                    'format'    => 'raw',
                    'value'     => function (Article $data) {
                        return $data->pub ? 'Да' : 'Нет';
                    }
                ],
                ['class' => 'yii\grid\ActionColumn']
            ]
        ]
    ); ?>

</div>
