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
                'id_old',
                'developer_id',
                'url:url',
                'title',
                'admin_title',
                'genre',
                'release_date',
                'platforms',
                'dev',
                'desc:ntext',
                'keywords:ntext',
                'publisher',
                'localizator',
                'status',
                'logo',
                'small_logo',
                'status_old',
                'date',
                'tweettag',
                'news_desc:ntext',
                'info:ntext',
                'specs:ntext',
                'ozon:ntext',
                'rate_pos',
                'rate_neg',
                'voted_users:ntext',
            ],
        ]
    ) ?>

</div>
