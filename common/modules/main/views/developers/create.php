<?php

use bioengine\common\modules\main\models\Developer;


/* @var $this yii\web\View */
/* @var $model Developer */

$this->title = Yii::t(
    'main/developers',
    'Добавить разработчика'
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Developers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-create">


    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>