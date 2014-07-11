<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "message_topic_user_map".
 *
 * @property integer $map_id
 * @property integer $map_user_id
 * @property integer $map_topic_id
 * @property string $map_folder_id
 * @property integer $map_read_time
 * @property integer $map_user_active
 * @property integer $map_user_banned
 * @property integer $map_has_unread
 * @property integer $map_is_system
 * @property integer $map_is_starter
 * @property integer $map_left_time
 * @property integer $map_ignore_notification
 * @property integer $map_last_topic_reply
 */
class IpbMessageTopicUserMap extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_topic_user_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['map_user_id', 'map_topic_id', 'map_read_time', 'map_user_active', 'map_user_banned', 'map_has_unread', 'map_is_system', 'map_is_starter', 'map_left_time', 'map_ignore_notification', 'map_last_topic_reply'], 'integer'],
            [['map_folder_id'], 'string', 'max' => 32],
            [['map_user_id', 'map_topic_id'], 'unique', 'targetAttribute' => ['map_user_id', 'map_topic_id'], 'message' => 'The combination of Map User ID and Map Topic ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'map_id' => Yii::t('app', 'Map ID'),
            'map_user_id' => Yii::t('app', 'Map User ID'),
            'map_topic_id' => Yii::t('app', 'Map Topic ID'),
            'map_folder_id' => Yii::t('app', 'Map Folder ID'),
            'map_read_time' => Yii::t('app', 'Map Read Time'),
            'map_user_active' => Yii::t('app', 'Map User Active'),
            'map_user_banned' => Yii::t('app', 'Map User Banned'),
            'map_has_unread' => Yii::t('app', 'Map Has Unread'),
            'map_is_system' => Yii::t('app', 'Map Is System'),
            'map_is_starter' => Yii::t('app', 'Map Is Starter'),
            'map_left_time' => Yii::t('app', 'Map Left Time'),
            'map_ignore_notification' => Yii::t('app', 'Map Ignore Notification'),
            'map_last_topic_reply' => Yii::t('app', 'Map Last Topic Reply'),
        ];
    }
}
