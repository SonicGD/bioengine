<?php

namespace bioengine\common\modules\news\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\helpers\UserHelper;
use bioengine\common\modules\ipb\models\IpbMember;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use bioengine\common\modules\news\models\search\NewsSearch;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "news".
 *
 * @property integer              $id
 * @property integer              $game_id
 * @property integer              $developer_id
 * @property integer              $topic_id
 * @property string               $url
 * @property string               $source
 * @property string               $game_old
 * @property string               $title
 * @property string               $short_text
 * @property string               $add_text
 * @property integer              $author_id
 * @property integer              $tid
 * @property integer              $pid
 * @property integer              $sticky
 * @property integer              $date
 * @property integer              $last_change_date
 * @property integer              $pub
 * @property string               $addgames
 * @property integer              $rate_pos
 * @property integer              $rate_neg
 * @property string               $voted_users
 * @property integer              $comments
 * @property string               $twitter_id
 *
 * @property Game                 $game
 * @property Developer            $developer
 * @property Topic                $topic
 * @property IpbMember            $author
 *
 * @property Game|Developer|Topic $parents
 */
class News extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['game_id'],
                'required',
                'when' => function ($model) {
                    return $model->developer_id == 0 && $model->topic_id == 0;
                },
            ],
            [
                ['game_id', 'developer_id', 'topic_id'],
                'default',
                'value' => 0
            ],
            [
                [
                    'game_id',
                    'developer_id',
                    'topic_id',
                    'author_id',
                    'tid',
                    'pid',
                    'sticky',
                    'date',
                    'last_change_date',
                    'pub',
                    'rate_pos',
                    'rate_neg',
                    'comments',
                    'twitter_id'
                ],
                'integer'
            ],
            [
                [
                    'source',
                    'title',
                    'url',
                    'short_text',
                    'add_text',
                    'last_change_date',
                ],
                'required'
            ],
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
            'id'               => Yii::t('app', 'ID'),
            'game_id'          => Yii::t('app', 'Game'),
            'developer_id'     => Yii::t('app', 'Developer'),
            'topic_id'         => Yii::t('app', 'Topic'),
            'url'              => Yii::t('app', 'Url'),
            'source'           => Yii::t('app', 'Source'),
            'game_old'         => Yii::t('app', 'Game Old'),
            'title'            => Yii::t('app', 'Title'),
            'short_text'       => Yii::t('app', 'Short Text'),
            'add_text'         => Yii::t('app', 'Add Text'),
            'author_id'        => Yii::t('app', 'Author'),
            'tid'              => Yii::t('app', 'Tid'),
            'pid'              => Yii::t('app', 'Pid'),
            'sticky'           => Yii::t('app', 'Sticky'),
            'date'             => Yii::t('app', 'Добавлена'),
            'last_change_date' => Yii::t('app', 'Изменена'),
            'pub'              => Yii::t('app', 'Pub'),
            'addgames'         => Yii::t('app', 'Addgames'),
            'rate_pos'         => Yii::t('app', 'Rate Pos'),
            'rate_neg'         => Yii::t('app', 'Rate Neg'),
            'voted_users'      => Yii::t('app', 'Voted Users'),
            'comments'         => Yii::t('app', 'Comments'),
            'twitter_id'       => Yii::t('app', 'Twitter ID'),
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord && !$this instanceof NewsSearch) {
                $this->date = time();
                $this->rate_pos = 0;
                $this->rate_neg = 0;
                $this->voted_users = json_encode([]);
                $this->comments = 0;
                $this->twitter_id = 0;
                $this->author_id = UserHelper::getUser()->member_id;
            }
            $this->last_change_date = time();

            return true;
        }

        return false;
    }

    public function getParentTitle()
    {
        $title = 'n/a';
        switch (true) {
            case $this->game_id > 0:
                $title = $this->game->admin_title ?: $this->game->title;
                break;
            case $this->developer_id > 0:
                $title = $this->developer->name;
                break;
            case $this->topic_id > 0:
                $title = $this->topic->title;
                break;
        }

        return $title;
    }

    public function getParentListUrl()
    {
        $url = '#';
        switch (true) {
            case $this->game_id > 0:
                $url = Url::toRoute(['/news/index/game', 'gameId' => $this->game_id]);
                break;
            case $this->developer_id > 0:
                $url = Url::toRoute(['/news/index/developer', 'developerId' => $this->game_id]);
                break;
            case $this->topic_id > 0:
                $url = Url::toRoute(['/news/index/topic', 'topicId' => $this->game_id]);
                break;
        }

        return $url;
    }

    public function getAuthor()
    {
        return $this->hasOne(IpbMember::className(), ['member_id' => 'author_id']);
    }

    public function getAuthorListUrl()
    {
        return Url::toRoute(['/news/index/author', 'authorId' => $this->author_id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeveloper()
    {
        return $this->hasOne(Developer::className(), ['id' => 'developer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
    }

    public function getPublicUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/news/show',
            [
                'year'    => date('Y', $this->date),
                'month'   => date('m', $this->date),
                'day'     => date('d', $this->date),
                'newsUrl' => $this->url
            ], $absolute, true);
    }

    public function getHasMore()
    {
        return $this->add_text !== '';
    }

    public function getParent()
    {
        $parent = null;
        switch (true) {
            case $this->game_id > 0:
                $parent = $this->game;
                break;
            case $this->developer_id > 0:
                $parent = $this->developer;
                break;
            case $this->topic_id > 0:
                $parent = $this->topic;
                break;
        }

        return $parent;

    }

    public function getForumUrl()
    {
        return '#';
    }

    public function getCommentsText()
    {
        return \Yii::t('app',
            '{n, plural, =0{Обсудить на форуме} =1{1 комментарий} one{# комментарий} few{# комментария} many{# комментариев} other{# комментария}}',
            ['n' => $this->comments]);
    }
}
