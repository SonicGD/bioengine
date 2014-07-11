<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "content_cache_posts".
 *
 * @property string  $cache_content_id
 * @property string  $cache_content
 * @property integer $cache_updated
 */
class IpbContentCachePost extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_cache_posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cache_content_id'], 'required'],
            [['cache_content_id', 'cache_updated'], 'integer'],
            [['cache_content'], 'string'],
            [['cache_content_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cache_content_id' => Yii::t('app', 'Cache Content ID'),
            'cache_content'    => Yii::t('app', 'Cache Content'),
            'cache_updated'    => Yii::t('app', 'Cache Updated'),
        ];
    }
}
