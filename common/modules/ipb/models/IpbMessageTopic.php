<?php

namespace bioengine\common\modules\ipb\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "message_topics".
 *
 * @property integer $mt_id
 * @property integer $mt_date
 * @property string  $mt_title
 * @property integer $mt_hasattach
 * @property integer $mt_starter_id
 * @property integer $mt_start_time
 * @property integer $mt_last_post_time
 * @property string  $mt_invited_members
 * @property integer $mt_to_count
 * @property integer $mt_to_member_id
 * @property integer $mt_replies
 * @property integer $mt_last_msg_id
 * @property integer $mt_first_msg_id
 * @property integer $mt_is_draft
 * @property integer $mt_is_deleted
 * @property integer $mt_is_system
 */
class IpbMessageTopic extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_topics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'mt_date',
                    'mt_hasattach',
                    'mt_starter_id',
                    'mt_start_time',
                    'mt_last_post_time',
                    'mt_to_count',
                    'mt_to_member_id',
                    'mt_replies',
                    'mt_last_msg_id',
                    'mt_first_msg_id',
                    'mt_is_draft',
                    'mt_is_deleted',
                    'mt_is_system'
                ],
                'integer'
            ],
            [['mt_invited_members'], 'string'],
            [['mt_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mt_id'              => Yii::t('app', 'Mt ID'),
            'mt_date'            => Yii::t('app', 'Mt Date'),
            'mt_title'           => Yii::t('app', 'Mt Title'),
            'mt_hasattach'       => Yii::t('app', 'Mt Hasattach'),
            'mt_starter_id'      => Yii::t('app', 'Mt Starter ID'),
            'mt_start_time'      => Yii::t('app', 'Mt Start Time'),
            'mt_last_post_time'  => Yii::t('app', 'Mt Last Post Time'),
            'mt_invited_members' => Yii::t('app', 'Mt Invited Members'),
            'mt_to_count'        => Yii::t('app', 'Mt To Count'),
            'mt_to_member_id'    => Yii::t('app', 'Mt To Member ID'),
            'mt_replies'         => Yii::t('app', 'Mt Replies'),
            'mt_last_msg_id'     => Yii::t('app', 'Mt Last Msg ID'),
            'mt_first_msg_id'    => Yii::t('app', 'Mt First Msg ID'),
            'mt_is_draft'        => Yii::t('app', 'Mt Is Draft'),
            'mt_is_deleted'      => Yii::t('app', 'Mt Is Deleted'),
            'mt_is_system'       => Yii::t('app', 'Mt Is System'),
        ];
    }
}
