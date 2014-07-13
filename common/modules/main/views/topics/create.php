<?php

use bioengine\common\modules\main\models\Topic;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Topic */

$this->title = Yii::t(
    'app',
    'Create {modelClass}',
    [
        'modelClass' => 'Topic',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
