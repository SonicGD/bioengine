<?php

use bioengine\modules\articles\models\search\ArticleSearch;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Article',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'source',
            'cat_id',
            'game_id',
            // 'developer_id',
            // 'topic_id',
            // 'game_old',
            // 'title',
            // 'announce:ntext',
            // 'text:ntext',
            // 'author_id',
            // 'count',
            // 'date',
            // 'pub',
            // 'fs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
