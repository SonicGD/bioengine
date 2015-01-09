<?php

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
                ['class' => 'yii\grid\SerialColumn'],
                'title:url',
                'url:url',
                'pid',
                'game_id',
                'developer_id',
                'topic_id',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
