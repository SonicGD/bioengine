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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t(
                'app',
                'Create {modelClass}',
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
                'id',
                'url:url',
                'game_old',
                'cat_id',
                'game_id',
                // 'developer_id',
                // 'title',
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
