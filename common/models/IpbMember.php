<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "members".
 *
 * @property integer $member_id
 * @property string  $name
 * @property integer $member_group_id
 * @property string  $email
 * @property integer $joined
 * @property string  $ip_address
 * @property integer $posts
 * @property string  $title
 * @property integer $allow_admin_mails
 * @property string  $time_offset
 * @property integer $skin
 * @property integer $warn_level
 * @property integer $warn_lastwarn
 * @property integer $language
 * @property integer $last_post
 * @property string  $restrict_post
 * @property integer $view_sigs
 * @property integer $view_img
 * @property integer $bday_day
 * @property integer $bday_month
 * @property integer $bday_year
 * @property integer $msg_count_new
 * @property integer $msg_count_total
 * @property integer $msg_count_reset
 * @property integer $msg_show_notification
 * @property string  $misc
 * @property integer $last_visit
 * @property integer $last_activity
 * @property integer $dst_in_use
 * @property integer $coppa_user
 * @property string  $mod_posts
 * @property string  $auto_track
 * @property string  $temp_ban
 * @property integer $sub_end
 * @property string  $login_anonymous
 * @property string  $ignored_users
 * @property string  $mgroup_others
 * @property string  $org_perm_id
 * @property string  $member_login_key
 * @property integer $member_login_key_expire
 * @property integer $subs_pkg_chosen
 * @property integer $has_blog
 * @property integer $has_gallery
 * @property string  $members_editor_choice
 * @property integer $members_auto_dst
 * @property string  $members_display_name
 * @property string  $members_seo_name
 * @property integer $members_created_remote
 * @property string  $members_cache
 * @property integer $members_disable_pm
 * @property string  $members_l_display_name
 * @property string  $members_l_username
 * @property string  $failed_logins
 * @property integer $failed_login_count
 * @property string  $members_profile_views
 * @property integer $forum_icons
 * @property string  $chat_color
 * @property integer $reputation
 * @property string  $members_pass_hash
 * @property string  $members_pass_salt
 * @property integer $member_banned
 * @property string  $identity_url
 * @property string  $member_uploader
 * @property string  $members_bitoptions
 * @property string  $fb_uid
 * @property string  $fb_emailhash
 * @property integer $fb_lastsync
 * @property string  $members_day_posts
 * @property string  $live_id
 * @property string  $twitter_id
 * @property string  $twitter_token
 * @property string  $twitter_secret
 * @property integer $notification_cnt
 * @property integer $tc_lastsync
 * @property string  $fb_session
 * @property string  $fb_token
 * @property string  $vk_uid
 * @property string  $ips_mobile_token
 * @property string  $ban_reason
 * @property string  $vk_token
 * @property integer $use_sign
 */
class IpbMember extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%members}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'member_group_id',
                    'joined',
                    'posts',
                    'allow_admin_mails',
                    'skin',
                    'warn_level',
                    'warn_lastwarn',
                    'language',
                    'last_post',
                    'view_sigs',
                    'view_img',
                    'bday_day',
                    'bday_month',
                    'bday_year',
                    'msg_count_new',
                    'msg_count_total',
                    'msg_count_reset',
                    'msg_show_notification',
                    'last_visit',
                    'last_activity',
                    'dst_in_use',
                    'coppa_user',
                    'sub_end',
                    'member_login_key_expire',
                    'subs_pkg_chosen',
                    'has_blog',
                    'has_gallery',
                    'members_auto_dst',
                    'members_created_remote',
                    'members_disable_pm',
                    'failed_login_count',
                    'members_profile_views',
                    'forum_icons',
                    'reputation',
                    'member_banned',
                    'members_bitoptions',
                    'fb_uid',
                    'fb_lastsync',
                    'notification_cnt',
                    'tc_lastsync',
                    'vk_uid',
                    'use_sign'
                ],
                'integer'
            ],
            [['ip_address'], 'required'],
            [['ignored_users', 'members_cache', 'failed_logins', 'identity_url', 'fb_token', 'vk_token'], 'string'],
            [
                [
                    'name',
                    'mgroup_others',
                    'org_perm_id',
                    'members_display_name',
                    'members_seo_name',
                    'members_l_display_name',
                    'members_l_username',
                    'twitter_id',
                    'twitter_token',
                    'twitter_secret',
                    'ban_reason'
                ],
                'string',
                'max' => 255
            ],
            [['email'], 'string', 'max' => 150],
            [['ip_address'], 'string', 'max' => 46],
            [['title', 'ips_mobile_token'], 'string', 'max' => 64],
            [['time_offset'], 'string', 'max' => 10],
            [['restrict_post', 'mod_posts', 'temp_ban'], 'string', 'max' => 100],
            [['misc'], 'string', 'max' => 128],
            [['auto_track'], 'string', 'max' => 50],
            [['login_anonymous', 'members_editor_choice'], 'string', 'max' => 3],
            [
                ['member_login_key', 'members_pass_hash', 'member_uploader', 'members_day_posts', 'live_id'],
                'string',
                'max' => 32
            ],
            [['chat_color'], 'string', 'max' => 7],
            [['members_pass_salt'], 'string', 'max' => 5],
            [['fb_emailhash'], 'string', 'max' => 60],
            [['fb_session'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id'               => Yii::t('app', 'Member ID'),
            'name'                    => Yii::t('app', 'Name'),
            'member_group_id'         => Yii::t('app', 'Member Group ID'),
            'email'                   => Yii::t('app', 'Email'),
            'joined'                  => Yii::t('app', 'Joined'),
            'ip_address'              => Yii::t('app', 'Ip Address'),
            'posts'                   => Yii::t('app', 'Posts'),
            'title'                   => Yii::t('app', 'Title'),
            'allow_admin_mails'       => Yii::t('app', 'Allow Admin Mails'),
            'time_offset'             => Yii::t('app', 'Time Offset'),
            'skin'                    => Yii::t('app', 'Skin'),
            'warn_level'              => Yii::t('app', 'Warn Level'),
            'warn_lastwarn'           => Yii::t('app', 'Warn Lastwarn'),
            'language'                => Yii::t('app', 'Language'),
            'last_post'               => Yii::t('app', 'Last Post'),
            'restrict_post'           => Yii::t('app', 'Restrict Post'),
            'view_sigs'               => Yii::t('app', 'View Sigs'),
            'view_img'                => Yii::t('app', 'View Img'),
            'bday_day'                => Yii::t('app', 'Bday Day'),
            'bday_month'              => Yii::t('app', 'Bday Month'),
            'bday_year'               => Yii::t('app', 'Bday Year'),
            'msg_count_new'           => Yii::t('app', 'Msg Count New'),
            'msg_count_total'         => Yii::t('app', 'Msg Count Total'),
            'msg_count_reset'         => Yii::t('app', 'Msg Count Reset'),
            'msg_show_notification'   => Yii::t('app', 'Msg Show Notification'),
            'misc'                    => Yii::t('app', 'Misc'),
            'last_visit'              => Yii::t('app', 'Last Visit'),
            'last_activity'           => Yii::t('app', 'Last Activity'),
            'dst_in_use'              => Yii::t('app', 'Dst In Use'),
            'coppa_user'              => Yii::t('app', 'Coppa User'),
            'mod_posts'               => Yii::t('app', 'Mod Posts'),
            'auto_track'              => Yii::t('app', 'Auto Track'),
            'temp_ban'                => Yii::t('app', 'Temp Ban'),
            'sub_end'                 => Yii::t('app', 'Sub End'),
            'login_anonymous'         => Yii::t('app', 'Login Anonymous'),
            'ignored_users'           => Yii::t('app', 'Ignored Users'),
            'mgroup_others'           => Yii::t('app', 'Mgroup Others'),
            'org_perm_id'             => Yii::t('app', 'Org Perm ID'),
            'member_login_key'        => Yii::t('app', 'Member Login Key'),
            'member_login_key_expire' => Yii::t('app', 'Member Login Key Expire'),
            'subs_pkg_chosen'         => Yii::t('app', 'Subs Pkg Chosen'),
            'has_blog'                => Yii::t('app', 'Has Blog'),
            'has_gallery'             => Yii::t('app', 'Has Gallery'),
            'members_editor_choice'   => Yii::t('app', 'Members Editor Choice'),
            'members_auto_dst'        => Yii::t('app', 'Members Auto Dst'),
            'members_display_name'    => Yii::t('app', 'Members Display Name'),
            'members_seo_name'        => Yii::t('app', 'Members Seo Name'),
            'members_created_remote'  => Yii::t('app', 'Members Created Remote'),
            'members_cache'           => Yii::t('app', 'Members Cache'),
            'members_disable_pm'      => Yii::t('app', 'Members Disable Pm'),
            'members_l_display_name'  => Yii::t('app', 'Members L Display Name'),
            'members_l_username'      => Yii::t('app', 'Members L Username'),
            'failed_logins'           => Yii::t('app', 'Failed Logins'),
            'failed_login_count'      => Yii::t('app', 'Failed Login Count'),
            'members_profile_views'   => Yii::t('app', 'Members Profile Views'),
            'forum_icons'             => Yii::t('app', 'Forum Icons'),
            'chat_color'              => Yii::t('app', 'Chat Color'),
            'reputation'              => Yii::t('app', 'Reputation'),
            'members_pass_hash'       => Yii::t('app', 'Members Pass Hash'),
            'members_pass_salt'       => Yii::t('app', 'Members Pass Salt'),
            'member_banned'           => Yii::t('app', 'Member Banned'),
            'identity_url'            => Yii::t('app', 'Identity Url'),
            'member_uploader'         => Yii::t('app', 'Member Uploader'),
            'members_bitoptions'      => Yii::t('app', 'Members Bitoptions'),
            'fb_uid'                  => Yii::t('app', 'Fb Uid'),
            'fb_emailhash'            => Yii::t('app', 'Fb Emailhash'),
            'fb_lastsync'             => Yii::t('app', 'Fb Lastsync'),
            'members_day_posts'       => Yii::t('app', 'Members Day Posts'),
            'live_id'                 => Yii::t('app', 'Live ID'),
            'twitter_id'              => Yii::t('app', 'Twitter ID'),
            'twitter_token'           => Yii::t('app', 'Twitter Token'),
            'twitter_secret'          => Yii::t('app', 'Twitter Secret'),
            'notification_cnt'        => Yii::t('app', 'Notification Cnt'),
            'tc_lastsync'             => Yii::t('app', 'Tc Lastsync'),
            'fb_session'              => Yii::t('app', 'Fb Session'),
            'fb_token'                => Yii::t('app', 'Fb Token'),
            'vk_uid'                  => Yii::t('app', 'Vk Uid'),
            'ips_mobile_token'        => Yii::t('app', 'Ips Mobile Token'),
            'ban_reason'              => Yii::t('app', 'Ban Reason'),
            'vk_token'                => Yii::t('app', 'Vk Token'),
            'use_sign'                => Yii::t('app', 'Use Sign'),
        ];
    }
}
