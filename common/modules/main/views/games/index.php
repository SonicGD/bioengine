<?php

use bioengine\common\modules\main\models\search\GameSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Games');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить игру',
                [
                    'modelClass' => 'Game',
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
                'url:url',
                'title',
                // 'admin_title',
                // 'genre',
                // 'release_date',
                // 'platforms',
                // 'dev',
                // 'desc:ntext',
                // 'keywords:ntext',
                // 'publisher',
                // 'localizator',
                // 'status',
                // 'logo',
                // 'small_logo',
                // 'status_old',
                // 'date',
                // 'tweettag',
                // 'news_desc:ntext',
                // 'info:ntext',
                // 'specs:ntext',
                // 'ozon:ntext',
                // 'rate_pos',
                // 'rate_neg',
                // 'voted_users:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
