<?php

use bioengine\common\modules\news\models\News;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model News */

$this->title = Yii::t(
        'app',
        'Update {modelClass}: ',
        [
            'modelClass' => 'News',
        ]
    ) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model'      => $model,
            'games'      => $games,
            'developers' => $developers,
            'topics'     => $topics
        ]
    ) ?>

</div>
