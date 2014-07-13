<?php

namespace bioengine\modules\articles\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "articles_cats".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $game_id
 * @property integer $developer_id
 * @property integer $topic_id
 * @property string  $title
 * @property string  $url
 * @property string  $descr
 * @property string  $game_old
 * @property string  $content
 * @property integer $articles
 */
class ArticleCat extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id', 'topic_id', 'articles'], 'integer'],
            [['content'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
            [['descr'], 'string', 'max' => 100],
            [['game_old'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'pid'          => Yii::t('app', 'Pid'),
            'game_id'      => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'topic_id'     => Yii::t('app', 'Topic ID'),
            'title'        => Yii::t('app', 'Title'),
            'url'          => Yii::t('app', 'Url'),
            'descr'        => Yii::t('app', 'Descr'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'content'      => Yii::t('app', 'Content'),
            'articles'     => Yii::t('app', 'Articles'),
        ];
    }
}
