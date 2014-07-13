<?php

use bioengine\common\modules\gallery\models\GalleryPic;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model GalleryPic */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Gallery Pic',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery Pics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-pic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
