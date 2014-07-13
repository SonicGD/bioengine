<?php

use bioengine\common\modules\main\models\SiteTeam;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model SiteTeam */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Site Team',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Site Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
