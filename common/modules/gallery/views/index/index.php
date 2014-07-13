<?php

use bioengine\common\modules\gallery\models\search\GalleryPicSearch;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel GalleryPicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gallery Pics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-pic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Gallery Pic',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'game_old',
            'cat_id',
            'game_id',
            'developer_id',
            // 'files:ntext',
            // 'desc:ntext',
            // 'author_id',
            // 'count',
            // 'date',
            // 'pub',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
