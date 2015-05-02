<?php

use bioengine\common\modules\articles\models\ArticleCat;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ArticleCat */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget(
        [
            'model'      => $model,
            'attributes' => [
                'id',
                [
                    'format' => 'url',
                    'label'  => 'Полный адрес',
                    'value'  => $model->getPublicUrl(true)
                ],
                [
                    'label' => 'Родительская Категория',
                    'value' => $model->parent ? $model->parent->title : 'Нет'
                ],
                [
                    'label' => 'Раздел',
                    'value' => $model->getParentTitle()
                ],
                'title',
                'descr:html',
                'content:html'
            ]
        ]
    ) ?>

</div>
