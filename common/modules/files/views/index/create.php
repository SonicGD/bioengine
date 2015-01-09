<?php

use bioengine\common\modules\files\models\File;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model File */

$this->title = Yii::t(
    'app',
    'Добавить файл',
    [
        'modelClass' => 'File',
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model'      => $model,
            'games'      => $games,
            'developers' => $developers,
        ]
    ) ?>

</div>
