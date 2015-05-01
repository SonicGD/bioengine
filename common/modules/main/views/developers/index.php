<?php

use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\search\DeveloperSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel DeveloperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Developers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить разработчика',
                [
                    'modelClass' => 'Developer',
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
                //'url:url',
                'name',
                [
                    'class'     => 'yii\grid\DataColumn',
                    'attribute' => 'logo',
                    'label'     => 'Лого',
                    'format'    => 'html',
                    'value'     => function (Developer $data) {
                        return $data->logo ? Html::img($data->getLogoUrl()) : 'n/a';
                    }
                ],
                //'info:ntext',
                //'desc:ntext',
                // 'logo',
                // 'found_year',
                // 'location:ntext',
                // 'peoples:ntext',
                // 'site',
                // 'rate_pos',
                // 'rate_neg',
                // 'voted_users:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Create {modelClass}',
                [
                    'modelClass' => 'Developer',
                ]
            ),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

</div>
