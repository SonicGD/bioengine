<?php

use bioengine\common\modules\main\models\Developer;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Developer */

$this->title = Yii::t(
        'app',
        'Редактировать разработчика: ',
        [
            'modelClass' => 'Developer',
        ]
    ) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Developers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
