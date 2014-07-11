<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_profile_portal".
 *
 * @property integer $pp_member_id
 * @property string $pp_last_visitors
 * @property string $pp_rating_hits
 * @property string $pp_rating_value
 * @property string $pp_rating_real
 * @property string $pp_main_photo
 * @property string $pp_main_width
 * @property string $pp_main_height
 * @property string $pp_thumb_photo
 * @property string $pp_thumb_width
 * @property string $pp_thumb_height
 * @property integer $pp_setting_moderate_comments
 * @property integer $pp_setting_moderate_friends
 * @property integer $pp_setting_count_friends
 * @property integer $pp_setting_count_comments
 * @property integer $pp_setting_count_visitors
 * @property string $pp_about_me
 * @property string $notes
 * @property string $signature
 * @property string $avatar_location
 * @property string $avatar_size
 * @property string $avatar_type
 * @property string $pconversation_filters
 * @property string $fb_photo
 * @property string $fb_photo_thumb
 * @property string $fb_bwoptions
 * @property integer $pp_reputation_points
 * @property string $pp_gravatar
 * @property string $pp_photo_type
 * @property string $tc_last_sid_import
 * @property string $tc_photo
 * @property string $tc_bwoptions
 * @property string $pp_customization
 * @property string $vk_bwoptions
 */
class ProfilePortal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_profile_portal}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pp_member_id', 'pp_last_visitors'], 'required'],
            [['pp_member_id', 'pp_rating_hits', 'pp_rating_value', 'pp_rating_real', 'pp_main_width', 'pp_main_height', 'pp_thumb_width', 'pp_thumb_height', 'pp_setting_moderate_comments', 'pp_setting_moderate_friends', 'pp_setting_count_friends', 'pp_setting_count_comments', 'pp_setting_count_visitors', 'fb_bwoptions', 'pp_reputation_points', 'tc_bwoptions', 'vk_bwoptions'], 'integer'],
            [['pp_last_visitors', 'pp_about_me', 'notes', 'signature', 'pconversation_filters', 'fb_photo', 'fb_photo_thumb', 'tc_photo', 'pp_customization'], 'string'],
            [['pp_main_photo', 'pp_thumb_photo', 'avatar_location', 'pp_gravatar'], 'string', 'max' => 255],
            [['avatar_size'], 'string', 'max' => 9],
            [['avatar_type'], 'string', 'max' => 15],
            [['pp_photo_type'], 'string', 'max' => 20],
            [['tc_last_sid_import'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pp_member_id' => Yii::t('app', 'Pp Member ID'),
            'pp_last_visitors' => Yii::t('app', 'Pp Last Visitors'),
            'pp_rating_hits' => Yii::t('app', 'Pp Rating Hits'),
            'pp_rating_value' => Yii::t('app', 'Pp Rating Value'),
            'pp_rating_real' => Yii::t('app', 'Pp Rating Real'),
            'pp_main_photo' => Yii::t('app', 'Pp Main Photo'),
            'pp_main_width' => Yii::t('app', 'Pp Main Width'),
            'pp_main_height' => Yii::t('app', 'Pp Main Height'),
            'pp_thumb_photo' => Yii::t('app', 'Pp Thumb Photo'),
            'pp_thumb_width' => Yii::t('app', 'Pp Thumb Width'),
            'pp_thumb_height' => Yii::t('app', 'Pp Thumb Height'),
            'pp_setting_moderate_comments' => Yii::t('app', 'Pp Setting Moderate Comments'),
            'pp_setting_moderate_friends' => Yii::t('app', 'Pp Setting Moderate Friends'),
            'pp_setting_count_friends' => Yii::t('app', 'Pp Setting Count Friends'),
            'pp_setting_count_comments' => Yii::t('app', 'Pp Setting Count Comments'),
            'pp_setting_count_visitors' => Yii::t('app', 'Pp Setting Count Visitors'),
            'pp_about_me' => Yii::t('app', 'Pp About Me'),
            'notes' => Yii::t('app', 'Notes'),
            'signature' => Yii::t('app', 'Signature'),
            'avatar_location' => Yii::t('app', 'Avatar Location'),
            'avatar_size' => Yii::t('app', 'Avatar Size'),
            'avatar_type' => Yii::t('app', 'Avatar Type'),
            'pconversation_filters' => Yii::t('app', 'Pconversation Filters'),
            'fb_photo' => Yii::t('app', 'Fb Photo'),
            'fb_photo_thumb' => Yii::t('app', 'Fb Photo Thumb'),
            'fb_bwoptions' => Yii::t('app', 'Fb Bwoptions'),
            'pp_reputation_points' => Yii::t('app', 'Pp Reputation Points'),
            'pp_gravatar' => Yii::t('app', 'Pp Gravatar'),
            'pp_photo_type' => Yii::t('app', 'Pp Photo Type'),
            'tc_last_sid_import' => Yii::t('app', 'Tc Last Sid Import'),
            'tc_photo' => Yii::t('app', 'Tc Photo'),
            'tc_bwoptions' => Yii::t('app', 'Tc Bwoptions'),
            'pp_customization' => Yii::t('app', 'Pp Customization'),
            'vk_bwoptions' => Yii::t('app', 'Vk Bwoptions'),
        ];
    }
}
