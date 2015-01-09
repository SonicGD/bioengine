<?php

use bioengine\common\modules\main\models\Game;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Game */

$this->title = Yii::t(
        'app',
        'Редактировать игру: ',
        [
            'modelClass' => 'Game',
        ]
    ) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Games'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model'      => $model,
            'developers' => $developers,
        ]
    ) ?>

</div>
