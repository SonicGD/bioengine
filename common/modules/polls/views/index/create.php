<?php

use bioengine\common\modules\polls\models\Poll;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Poll */

$this->title = Yii::t(
    'app',
    'Добавить опрос',
    [
        'modelClass' => 'Poll',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-create">

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
