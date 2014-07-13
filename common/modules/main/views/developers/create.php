<?php

use bioengine\common\modules\main\models\Developer;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Developer */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Developer',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Developers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
