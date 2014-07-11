<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news_archive".
 *
 * @property integer $id
 * @property integer $news_id
 * @property string $url
 * @property string $source
 * @property string $title
 * @property string $short_text
 * @property string $add_text
 * @property integer $sticky
 * @property integer $pub
 * @property integer $member_id
 * @property string $member_name
 * @property integer $date
 * @property integer $change_date
 */
class NewsArchive extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_archive}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'url', 'source', 'title', 'short_text', 'add_text', 'sticky', 'pub', 'member_id', 'member_name', 'date', 'change_date'], 'required'],
            [['news_id', 'sticky', 'pub', 'member_id', 'date', 'change_date'], 'integer'],
            [['short_text', 'add_text'], 'string'],
            [['url', 'source', 'title', 'member_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'news_id' => Yii::t('app', 'News ID'),
            'url' => Yii::t('app', 'Url'),
            'source' => Yii::t('app', 'Source'),
            'title' => Yii::t('app', 'Title'),
            'short_text' => Yii::t('app', 'Short Text'),
            'add_text' => Yii::t('app', 'Add Text'),
            'sticky' => Yii::t('app', 'Sticky'),
            'pub' => Yii::t('app', 'Pub'),
            'member_id' => Yii::t('app', 'Member ID'),
            'member_name' => Yii::t('app', 'Member Name'),
            'date' => Yii::t('app', 'Date'),
            'change_date' => Yii::t('app', 'Change Date'),
        ];
    }
}
