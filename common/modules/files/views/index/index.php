<?php

use bioengine\common\modules\files\models\search\FileSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Добавить файл',
                [
                    'modelClass' => 'File',
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
                'title',
                'url:url',
                'cat_id',
                'game_id',
                'developer_id',
                // 'desc:ntext',
                // 'announce:ntext',
                // 'file',
                // 'link',
                // 'size',
                // 'stream',
                // 'streamfile',
                // 'yt_status',
                // 'yt_title',
                // 'yt_url:url',
                // 'author_id',
                // 'count',
                // 'date',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

</div>
