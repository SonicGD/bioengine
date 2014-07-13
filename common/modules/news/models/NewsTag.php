<?php

namespace bioengine\common\modules\news\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "news_tags".
 *
 * @property integer $id
 * @property integer $news_id
 * @property integer $tag_id
 */
class NewsTag extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'tag_id'], 'required'],
            [['news_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('app', 'ID'),
            'news_id' => Yii::t('app', 'News ID'),
            'tag_id'  => Yii::t('app', 'Tag ID'),
        ];
    }
}
