<?php

use bioengine\common\modules\polls\models\Poll;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Poll */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Poll',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
