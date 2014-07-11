<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_forums".
 *
 * @property integer $id
 * @property integer $topics
 * @property integer $posts
 * @property integer $last_post
 * @property integer $last_poster_id
 * @property string $last_poster_name
 * @property string $name
 * @property string $description
 * @property string $position
 * @property integer $use_ibc
 * @property integer $use_html
 * @property string $password
 * @property string $password_override
 * @property string $last_title
 * @property integer $last_id
 * @property string $sort_key
 * @property string $sort_order
 * @property integer $prune
 * @property string $topicfilter
 * @property integer $show_rules
 * @property integer $preview_posts
 * @property integer $allow_poll
 * @property integer $allow_pollbump
 * @property integer $inc_postcount
 * @property integer $skin_id
 * @property integer $parent_id
 * @property string $redirect_url
 * @property integer $redirect_on
 * @property integer $redirect_hits
 * @property string $rules_title
 * @property string $rules_text
 * @property string $notify_modq_emails
 * @property integer $sub_can_post
 * @property string $permission_custom_error
 * @property integer $permission_showtopic
 * @property integer $queued_topics
 * @property integer $queued_posts
 * @property integer $forum_allow_rating
 * @property integer $forum_last_deletion
 * @property string $newest_title
 * @property integer $newest_id
 * @property string $icon
 * @property integer $can_view_others
 * @property string $min_posts_post
 * @property string $min_posts_view
 * @property integer $hide_last_info
 * @property string $name_seo
 * @property string $seo_last_title
 * @property string $seo_last_name
 * @property string $last_x_topic_ids
 * @property string $forums_bitoptions
 * @property integer $disable_sharelinks
 * @property integer $deleted_posts
 * @property integer $deleted_topics
 * @property integer $rules_raw_html
 * @property string $tag_predefined
 * @property string $ipseo_priority
 */
class Forum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_forums}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topics', 'posts', 'last_post', 'last_poster_id', 'position', 'use_ibc', 'use_html', 'last_id', 'prune', 'show_rules', 'preview_posts', 'allow_poll', 'allow_pollbump', 'inc_postcount', 'skin_id', 'parent_id', 'redirect_on', 'redirect_hits', 'sub_can_post', 'permission_showtopic', 'queued_topics', 'queued_posts', 'forum_allow_rating', 'forum_last_deletion', 'newest_id', 'can_view_others', 'min_posts_post', 'min_posts_view', 'hide_last_info', 'forums_bitoptions', 'disable_sharelinks', 'deleted_posts', 'deleted_topics', 'rules_raw_html'], 'integer'],
            [['description', 'rules_text', 'notify_modq_emails', 'permission_custom_error', 'icon', 'last_x_topic_ids', 'tag_predefined'], 'string'],
            [['permission_custom_error', 'icon', 'min_posts_post', 'min_posts_view'], 'required'],
            [['last_poster_name', 'password_override', 'rules_title', 'name_seo', 'seo_last_title', 'seo_last_name'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 128],
            [['password', 'sort_key', 'sort_order', 'topicfilter'], 'string', 'max' => 32],
            [['last_title', 'redirect_url', 'newest_title'], 'string', 'max' => 250],
            [['ipseo_priority'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'topics' => Yii::t('app', 'Topics'),
            'posts' => Yii::t('app', 'Posts'),
            'last_post' => Yii::t('app', 'Last Post'),
            'last_poster_id' => Yii::t('app', 'Last Poster ID'),
            'last_poster_name' => Yii::t('app', 'Last Poster Name'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'position' => Yii::t('app', 'Position'),
            'use_ibc' => Yii::t('app', 'Use Ibc'),
            'use_html' => Yii::t('app', 'Use Html'),
            'password' => Yii::t('app', 'Password'),
            'password_override' => Yii::t('app', 'Password Override'),
            'last_title' => Yii::t('app', 'Last Title'),
            'last_id' => Yii::t('app', 'Last ID'),
            'sort_key' => Yii::t('app', 'Sort Key'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'prune' => Yii::t('app', 'Prune'),
            'topicfilter' => Yii::t('app', 'Topicfilter'),
            'show_rules' => Yii::t('app', 'Show Rules'),
            'preview_posts' => Yii::t('app', 'Preview Posts'),
            'allow_poll' => Yii::t('app', 'Allow Poll'),
            'allow_pollbump' => Yii::t('app', 'Allow Pollbump'),
            'inc_postcount' => Yii::t('app', 'Inc Postcount'),
            'skin_id' => Yii::t('app', 'Skin ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'redirect_url' => Yii::t('app', 'Redirect Url'),
            'redirect_on' => Yii::t('app', 'Redirect On'),
            'redirect_hits' => Yii::t('app', 'Redirect Hits'),
            'rules_title' => Yii::t('app', 'Rules Title'),
            'rules_text' => Yii::t('app', 'Rules Text'),
            'notify_modq_emails' => Yii::t('app', 'Notify Modq Emails'),
            'sub_can_post' => Yii::t('app', 'Sub Can Post'),
            'permission_custom_error' => Yii::t('app', 'Permission Custom Error'),
            'permission_showtopic' => Yii::t('app', 'Permission Showtopic'),
            'queued_topics' => Yii::t('app', 'Queued Topics'),
            'queued_posts' => Yii::t('app', 'Queued Posts'),
            'forum_allow_rating' => Yii::t('app', 'Forum Allow Rating'),
            'forum_last_deletion' => Yii::t('app', 'Forum Last Deletion'),
            'newest_title' => Yii::t('app', 'Newest Title'),
            'newest_id' => Yii::t('app', 'Newest ID'),
            'icon' => Yii::t('app', 'Icon'),
            'can_view_others' => Yii::t('app', 'Can View Others'),
            'min_posts_post' => Yii::t('app', 'Min Posts Post'),
            'min_posts_view' => Yii::t('app', 'Min Posts View'),
            'hide_last_info' => Yii::t('app', 'Hide Last Info'),
            'name_seo' => Yii::t('app', 'Name Seo'),
            'seo_last_title' => Yii::t('app', 'Seo Last Title'),
            'seo_last_name' => Yii::t('app', 'Seo Last Name'),
            'last_x_topic_ids' => Yii::t('app', 'Last X Topic Ids'),
            'forums_bitoptions' => Yii::t('app', 'Forums Bitoptions'),
            'disable_sharelinks' => Yii::t('app', 'Disable Sharelinks'),
            'deleted_posts' => Yii::t('app', 'Deleted Posts'),
            'deleted_topics' => Yii::t('app', 'Deleted Topics'),
            'rules_raw_html' => Yii::t('app', 'Rules Raw Html'),
            'tag_predefined' => Yii::t('app', 'Tag Predefined'),
            'ipseo_priority' => Yii::t('app', 'Ipseo Priority'),
        ];
    }
}
