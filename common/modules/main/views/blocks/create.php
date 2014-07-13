<?php

use bioengine\common\modules\main\models\Block;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Block */

$this->title = Yii::t(
    'app',
    'Create {modelClass}',
    [
        'modelClass' => 'Block',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
