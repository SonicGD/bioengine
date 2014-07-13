<?php

use bioengine\common\modules\main\models\Settings;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Settings */

$this->title = Yii::t(
    'app',
    'Create {modelClass}',
    [
        'modelClass' => 'Settings',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
