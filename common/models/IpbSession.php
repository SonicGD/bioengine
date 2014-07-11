<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sessions".
 *
 * @property string  $id
 * @property string  $member_name
 * @property string  $seo_name
 * @property integer $member_id
 * @property string  $ip_address
 * @property string  $browser
 * @property integer $running_time
 * @property integer $login_type
 * @property integer $member_group
 * @property integer $in_error
 * @property string  $location_1_type
 * @property integer $location_1_id
 * @property string  $location_2_type
 * @property integer $location_2_id
 * @property string  $location_3_type
 * @property integer $location_3_id
 * @property string  $current_appcomponent
 * @property string  $current_module
 * @property string  $current_section
 * @property string  $uagent_key
 * @property string  $uagent_version
 * @property string  $uagent_type
 * @property integer $uagent_bypass
 * @property integer $search_thread_id
 * @property integer $search_thread_time
 * @property integer $session_msg_id
 */
class IpbSession extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sessions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location_1_type', 'location_2_type', 'location_3_type'], 'required'],
            [
                [
                    'member_id',
                    'running_time',
                    'login_type',
                    'member_group',
                    'in_error',
                    'location_1_id',
                    'location_2_id',
                    'location_3_id',
                    'uagent_bypass',
                    'search_thread_id',
                    'search_thread_time',
                    'session_msg_id'
                ],
                'integer'
            ],
            [['id'], 'string', 'max' => 60],
            [
                ['member_name', 'seo_name', 'location_1_type', 'location_2_type', 'location_3_type'],
                'string',
                'max' => 255
            ],
            [['ip_address'], 'string', 'max' => 46],
            [['browser', 'uagent_key', 'uagent_type'], 'string', 'max' => 200],
            [['current_appcomponent', 'current_module', 'current_section', 'uagent_version'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                   => Yii::t('app', 'ID'),
            'member_name'          => Yii::t('app', 'Member Name'),
            'seo_name'             => Yii::t('app', 'Seo Name'),
            'member_id'            => Yii::t('app', 'Member ID'),
            'ip_address'           => Yii::t('app', 'Ip Address'),
            'browser'              => Yii::t('app', 'Browser'),
            'running_time'         => Yii::t('app', 'Running Time'),
            'login_type'           => Yii::t('app', 'Login Type'),
            'member_group'         => Yii::t('app', 'Member Group'),
            'in_error'             => Yii::t('app', 'In Error'),
            'location_1_type'      => Yii::t('app', 'Location 1 Type'),
            'location_1_id'        => Yii::t('app', 'Location 1 ID'),
            'location_2_type'      => Yii::t('app', 'Location 2 Type'),
            'location_2_id'        => Yii::t('app', 'Location 2 ID'),
            'location_3_type'      => Yii::t('app', 'Location 3 Type'),
            'location_3_id'        => Yii::t('app', 'Location 3 ID'),
            'current_appcomponent' => Yii::t('app', 'Current Appcomponent'),
            'current_module'       => Yii::t('app', 'Current Module'),
            'current_section'      => Yii::t('app', 'Current Section'),
            'uagent_key'           => Yii::t('app', 'Uagent Key'),
            'uagent_version'       => Yii::t('app', 'Uagent Version'),
            'uagent_type'          => Yii::t('app', 'Uagent Type'),
            'uagent_bypass'        => Yii::t('app', 'Uagent Bypass'),
            'search_thread_id'     => Yii::t('app', 'Search Thread ID'),
            'search_thread_time'   => Yii::t('app', 'Search Thread Time'),
            'session_msg_id'       => Yii::t('app', 'Session Msg ID'),
        ];
    }
}
