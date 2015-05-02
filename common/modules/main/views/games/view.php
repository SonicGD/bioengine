<?php

use bioengine\common\modules\main\models\Game;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Game */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
            ]
        ) ?>
    </p>

    <?= DetailView::widget(
        [
            'model'      => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'developer_id',
                    'value'     => $model->developer->name
                ],
                [
                    'format' => 'url',
                    'label'  => 'Полный адрес',
                    'value'  => $model->getPublicUrl(true)
                ],
                'title',
                'genre',
                'release_date',
                'platforms',
                'desc:html',
                'keywords:ntext',
                'publisher',
                'localizator',
                [
                    'attribute' => 'logo',
                    'format'    => 'html',
                    'value'     => $model->logo ? Html::img($model->getBigLogoUrl()) : 'n/a'
                ],
                [
                    'attribute' => 'small_logo',
                    'format'    => 'html',
                    'value'     => $model->small_logo ? Html::img($model->getSmallLogoUrl()) : 'n/a'
                ],
                'date:datetime',
                'tweettag',
                'news_desc:html',
                //'info:ntext',
                //'specs:ntext',
                //'ozon:ntext',
                //'rate_pos',
                //'rate_neg',
                //'voted_users:ntext',
            ],
        ]
    ) ?>

</div>
