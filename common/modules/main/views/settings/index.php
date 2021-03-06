<?php

use bioengine\common\modules\main\models\search\SettingsSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Create {modelClass}',
                [
                    'modelClass' => 'Settings',
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
                'name',
                'title',
                'type',
                'desc:ntext',
                // 'value:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
