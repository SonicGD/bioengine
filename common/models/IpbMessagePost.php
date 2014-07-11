<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "message_posts".
 *
 * @property integer $msg_id
 * @property integer $msg_topic_id
 * @property integer $msg_date
 * @property string  $msg_post
 * @property string  $msg_post_key
 * @property integer $msg_author_id
 * @property string  $msg_ip_address
 * @property integer $msg_is_first_post
 */
class IpbMessagePost extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg_topic_id', 'msg_date', 'msg_author_id', 'msg_is_first_post'], 'integer'],
            [['msg_post'], 'string'],
            [['msg_post_key'], 'string', 'max' => 32],
            [['msg_ip_address'], 'string', 'max' => 46]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg_id'            => Yii::t('app', 'Msg ID'),
            'msg_topic_id'      => Yii::t('app', 'Msg Topic ID'),
            'msg_date'          => Yii::t('app', 'Msg Date'),
            'msg_post'          => Yii::t('app', 'Msg Post'),
            'msg_post_key'      => Yii::t('app', 'Msg Post Key'),
            'msg_author_id'     => Yii::t('app', 'Msg Author ID'),
            'msg_ip_address'    => Yii::t('app', 'Msg Ip Address'),
            'msg_is_first_post' => Yii::t('app', 'Msg Is First Post'),
        ];
    }
}
