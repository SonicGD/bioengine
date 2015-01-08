<?php

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
                'Create {modelClass}',
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
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'game_id',
                'developer_id',
                'topic_id',
                // 'source',
                // 'game_old',
                'title',
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
