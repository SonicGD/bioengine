<?php

use bioengine\common\modules\main\models\Topic;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Topic */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Topic',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="topic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
