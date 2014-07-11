<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "posts".
 *
 * @property integer $pid
 * @property integer $append_edit
 * @property integer $edit_time
 * @property integer $author_id
 * @property string $author_name
 * @property integer $use_sig
 * @property integer $use_emo
 * @property string $ip_address
 * @property integer $post_date
 * @property integer $icon_id
 * @property string $post
 * @property integer $queued
 * @property integer $topic_id
 * @property string $post_title
 * @property integer $new_topic
 * @property string $edit_name
 * @property string $post_key
 * @property integer $post_htmlstate
 * @property string $post_edit_reason
 * @property integer $post_pinned
 * @property string $post_bwoptions
 * @property integer $pdelete_time
 * @property integer $post_field_int
 * @property string $post_field_t1
 * @property string $post_field_t2
 */
class IpbPost extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['append_edit', 'edit_time', 'author_id', 'use_sig', 'use_emo', 'post_date', 'icon_id', 'queued', 'topic_id', 'new_topic', 'post_htmlstate', 'post_pinned', 'post_bwoptions', 'pdelete_time', 'post_field_int'], 'integer'],
            [['ip_address'], 'required'],
            [['post', 'post_field_t1', 'post_field_t2'], 'string'],
            [['author_name', 'post_title', 'edit_name', 'post_edit_reason'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 46],
            [['post_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pid' => Yii::t('app', 'Pid'),
            'append_edit' => Yii::t('app', 'Append Edit'),
            'edit_time' => Yii::t('app', 'Edit Time'),
            'author_id' => Yii::t('app', 'Author ID'),
            'author_name' => Yii::t('app', 'Author Name'),
            'use_sig' => Yii::t('app', 'Use Sig'),
            'use_emo' => Yii::t('app', 'Use Emo'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'post_date' => Yii::t('app', 'Post Date'),
            'icon_id' => Yii::t('app', 'Icon ID'),
            'post' => Yii::t('app', 'Post'),
            'queued' => Yii::t('app', 'Queued'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'post_title' => Yii::t('app', 'Post Title'),
            'new_topic' => Yii::t('app', 'New Topic'),
            'edit_name' => Yii::t('app', 'Edit Name'),
            'post_key' => Yii::t('app', 'Post Key'),
            'post_htmlstate' => Yii::t('app', 'Post Htmlstate'),
            'post_edit_reason' => Yii::t('app', 'Post Edit Reason'),
            'post_pinned' => Yii::t('app', 'Post Pinned'),
            'post_bwoptions' => Yii::t('app', 'Post Bwoptions'),
            'pdelete_time' => Yii::t('app', 'Pdelete Time'),
            'post_field_int' => Yii::t('app', 'Post Field Int'),
            'post_field_t1' => Yii::t('app', 'Post Field T1'),
            'post_field_t2' => Yii::t('app', 'Post Field T2'),
        ];
    }
}
