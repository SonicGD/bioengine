<?php

use bioengine\common\modules\news\models\News;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model News */

$this->title = Yii::t(
    'app',
    'Create {modelClass}',
    [
        'modelClass' => 'News',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

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
