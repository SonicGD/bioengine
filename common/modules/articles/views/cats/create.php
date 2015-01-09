<?php

use bioengine\modules\articles\models\Article;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ArticleCat */

$this->title = Yii::t(
    'app',
    'Добавить категорию',
    [
        'modelClass' => 'ArticleCat',
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
