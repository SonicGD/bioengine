<?php

use bioengine\modules\articles\models\Article;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ArticleCat */

$this->title = Yii::t(
        'app',
        'Редактировать категорию: ',
        [
            'modelClass' => 'ArticleCat',
        ]
    ) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

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
