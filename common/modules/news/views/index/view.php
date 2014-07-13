<?php

use bioengine\common\modules\news\models\News;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

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
                'game_id',
                'developer_id',
                'topic_id',
                'url:url',
                'source',
                'game_old',
                'title',
                'short_text:ntext',
                'add_text:ntext',
                'author_id',
                'tid',
                'pid',
                'sticky',
                'date',
                'last_change_date',
                'pub',
                'addgames',
                'rate_pos',
                'rate_neg',
                'voted_users:ntext',
                'comments',
                'twitter_id',
            ],
        ]
    ) ?>

</div>
