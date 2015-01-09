<?php

use bioengine\common\modules\main\models\Game;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Game */

$this->title = Yii::t(
    'app',
    'Добавить игру',
    [
        'modelClass' => 'Game',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model'      => $model,
            'developers' => $developers,
        ]
    ) ?>

</div>
