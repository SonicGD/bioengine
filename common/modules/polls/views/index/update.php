<?php

use bioengine\common\modules\polls\models\Poll;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Poll */

$this->title = Yii::t(
        'app',
        'Редактировать опрос: ',
        [
            'modelClass' => 'Poll',
        ]
    ) . ' ' . $model->poll_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->poll_id, 'url' => ['view', 'id' => $model->poll_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="poll-update">

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
