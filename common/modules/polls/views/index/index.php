<?php

use bioengine\common\modules\polls\models\search\PollSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel PollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Polls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-index">

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить опрос',
                [
                    'modelClass' => 'Poll',
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
                'question',
                'startdate:date',
                'optionsEdit:html',
                // 'num_choices',
                // 'multiple',
                // 'onoff',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
