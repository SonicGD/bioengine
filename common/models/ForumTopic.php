<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_topics".
 *
 * @property integer $tid
 * @property string $title
 * @property string $description
 * @property string $state
 * @property integer $posts
 * @property integer $starter_id
 * @property integer $start_date
 * @property integer $last_poster_id
 * @property integer $last_post
 * @property integer $icon_id
 * @property string $starter_name
 * @property string $last_poster_name
 * @property string $poll_state
 * @property integer $last_vote
 * @property integer $views
 * @property integer $forum_id
 * @property integer $approved
 * @property integer $author_mode
 * @property integer $pinned
 * @property string $moved_to
 * @property integer $topic_hasattach
 * @property integer $topic_firstpost
 * @property integer $topic_queuedposts
 * @property integer $topic_open_time
 * @property integer $topic_close_time
 * @property integer $topic_rating_total
 * @property integer $topic_rating_hits
 * @property string $pinned_post
 * @property string $title_seo
 * @property string $seo_last_name
 * @property string $seo_first_name
 * @property integer $topic_deleted_posts
 * @property integer $tdelete_time
 * @property integer $moved_on
 * @property string $banned_members
 */
class ForumTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_topics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['posts', 'starter_id', 'start_date', 'last_poster_id', 'last_post', 'icon_id', 'last_vote', 'views', 'forum_id', 'approved', 'author_mode', 'pinned', 'topic_hasattach', 'topic_firstpost', 'topic_queuedposts', 'topic_open_time', 'topic_close_time', 'topic_rating_total', 'topic_rating_hits', 'pinned_post', 'topic_deleted_posts', 'tdelete_time', 'moved_on'], 'integer'],
            [['banned_members'], 'string'],
            [['title', 'description', 'title_seo'], 'string', 'max' => 250],
            [['state', 'poll_state'], 'string', 'max' => 8],
            [['starter_name', 'last_poster_name', 'seo_last_name', 'seo_first_name'], 'string', 'max' => 255],
            [['moved_to'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tid' => Yii::t('app', 'Tid'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'state' => Yii::t('app', 'State'),
            'posts' => Yii::t('app', 'Posts'),
            'starter_id' => Yii::t('app', 'Starter ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'last_poster_id' => Yii::t('app', 'Last Poster ID'),
            'last_post' => Yii::t('app', 'Last Post'),
            'icon_id' => Yii::t('app', 'Icon ID'),
            'starter_name' => Yii::t('app', 'Starter Name'),
            'last_poster_name' => Yii::t('app', 'Last Poster Name'),
            'poll_state' => Yii::t('app', 'Poll State'),
            'last_vote' => Yii::t('app', 'Last Vote'),
            'views' => Yii::t('app', 'Views'),
            'forum_id' => Yii::t('app', 'Forum ID'),
            'approved' => Yii::t('app', 'Approved'),
            'author_mode' => Yii::t('app', 'Author Mode'),
            'pinned' => Yii::t('app', 'Pinned'),
            'moved_to' => Yii::t('app', 'Moved To'),
            'topic_hasattach' => Yii::t('app', 'Topic Hasattach'),
            'topic_firstpost' => Yii::t('app', 'Topic Firstpost'),
            'topic_queuedposts' => Yii::t('app', 'Topic Queuedposts'),
            'topic_open_time' => Yii::t('app', 'Topic Open Time'),
            'topic_close_time' => Yii::t('app', 'Topic Close Time'),
            'topic_rating_total' => Yii::t('app', 'Topic Rating Total'),
            'topic_rating_hits' => Yii::t('app', 'Topic Rating Hits'),
            'pinned_post' => Yii::t('app', 'Pinned Post'),
            'title_seo' => Yii::t('app', 'Title Seo'),
            'seo_last_name' => Yii::t('app', 'Seo Last Name'),
            'seo_first_name' => Yii::t('app', 'Seo First Name'),
            'topic_deleted_posts' => Yii::t('app', 'Topic Deleted Posts'),
            'tdelete_time' => Yii::t('app', 'Tdelete Time'),
            'moved_on' => Yii::t('app', 'Moved On'),
            'banned_members' => Yii::t('app', 'Banned Members'),
        ];
    }
}
