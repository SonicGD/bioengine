<?php

use bioengine\common\modules\main\models\Game;
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
                [
                    'attribute' => 'developer_id',
                    'value'     => function (Game $game) {
                        return $game->developer->name;
                    }
                ],
                'title',
                ['class' => 'yii\grid\ActionColumn']
            ]
        ]
    ); ?>

</div>
