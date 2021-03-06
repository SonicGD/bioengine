<?php

use bioengine\modules\articles\models\Article;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Article */

$this->title = Yii::t(
    'app',
    'Добавить статью',
    [
        'modelClass' => 'Article',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
            'games'      => $games,
            'developers' => $developers,
            'topics'     => $topics
        ]
    ) ?>

</div>
