<?php

namespace bioengine\common\modules\articles\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property integer    $id
 * @property string     $url
 * @property string     $source
 * @property integer    $cat_id
 * @property integer    $game_id
 * @property integer    $developer_id
 * @property integer    $topic_id
 * @property string     $game_old
 * @property string     $title
 * @property string     $announce
 * @property string     $text
 * @property integer    $author_id
 * @property integer    $count
 * @property integer    $date
 * @property integer    $pub
 * @property integer    $fs
 *
 * @property ArticleCat $cat
 */
class Article extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['game_id'],
                'required',
                'when' => function ($model) {
                    return $model->developer_id == 0 && $model->topic_id == 0;
                },
            ],
            [
                ['game_id', 'developer_id', 'topic_id'],
                'default',
                'value' => 0
            ],
            [['cat_id', 'game_id', 'developer_id', 'topic_id', 'author_id', 'count', 'date', 'pub', 'fs'], 'integer'],
            [['announce', 'text'], 'string'],
            [['text'], 'required'],
            [['url', 'source'], 'string', 'max' => 255],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'url'          => Yii::t('app', 'Url'),
            'source'       => Yii::t('app', 'Source'),
            'cat_id'       => Yii::t('app', 'Cat'),
            'game_id'      => Yii::t('app', 'Game'),
            'developer_id' => Yii::t('app', 'Developer'),
            'topic_id'     => Yii::t('app', 'Topic'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'title'        => Yii::t('app', 'Title'),
            'announce'     => Yii::t('app', 'Announce'),
            'text'         => Yii::t('app', 'Text'),
            'author_id'    => Yii::t('app', 'Author'),
            'count'        => Yii::t('app', 'Count'),
            'date'         => Yii::t('app', 'Date'),
            'pub'          => Yii::t('app', 'Pub'),
            'fs'           => Yii::t('app', 'Fs'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(ArticleCat::className(), ['id' => 'cat_id']);
    }
}
