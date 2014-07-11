<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_news".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $developer_id
 * @property integer $topic_id
 * @property string $url
 * @property string $source
 * @property string $game_old
 * @property string $title
 * @property string $short_text
 * @property string $add_text
 * @property integer $author_id
 * @property integer $tid
 * @property integer $pid
 * @property integer $sticky
 * @property integer $date
 * @property integer $last_change_date
 * @property integer $pub
 * @property string $addgames
 * @property integer $rate_pos
 * @property integer $rate_neg
 * @property string $voted_users
 * @property integer $comments
 * @property string $twitter_id
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'developer_id', 'topic_id', 'author_id', 'tid', 'pid', 'sticky', 'date', 'last_change_date', 'pub', 'rate_pos', 'rate_neg', 'comments', 'twitter_id'], 'integer'],
            [['source', 'title', 'short_text', 'add_text', 'last_change_date', 'addgames', 'rate_pos', 'rate_neg', 'voted_users', 'comments', 'twitter_id'], 'required'],
            [['short_text', 'add_text', 'voted_users'], 'string'],
            [['url', 'source', 'title', 'addgames'], 'string', 'max' => 255],
            [['game_old'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'game_id' => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'url' => Yii::t('app', 'Url'),
            'source' => Yii::t('app', 'Source'),
            'game_old' => Yii::t('app', 'Game Old'),
            'title' => Yii::t('app', 'Title'),
            'short_text' => Yii::t('app', 'Short Text'),
            'add_text' => Yii::t('app', 'Add Text'),
            'author_id' => Yii::t('app', 'Author ID'),
            'tid' => Yii::t('app', 'Tid'),
            'pid' => Yii::t('app', 'Pid'),
            'sticky' => Yii::t('app', 'Sticky'),
            'date' => Yii::t('app', 'Date'),
            'last_change_date' => Yii::t('app', 'Last Change Date'),
            'pub' => Yii::t('app', 'Pub'),
            'addgames' => Yii::t('app', 'Addgames'),
            'rate_pos' => Yii::t('app', 'Rate Pos'),
            'rate_neg' => Yii::t('app', 'Rate Neg'),
            'voted_users' => Yii::t('app', 'Voted Users'),
            'comments' => Yii::t('app', 'Comments'),
            'twitter_id' => Yii::t('app', 'Twitter ID'),
        ];
    }
}
