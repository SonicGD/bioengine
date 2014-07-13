<?php

use bioengine\common\modules\main\models\Block;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Block */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Block',
]) . ' ' . $model->index;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->index, 'url' => ['view', 'id' => $model->index]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
