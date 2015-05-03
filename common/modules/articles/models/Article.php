<?php

namespace bioengine\common\modules\articles\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\helpers\UserHelper;
use bioengine\common\modules\ipb\models\IpbMember;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "articles".
 *
 * @property integer        $id
 * @property string         $url
 * @property string         $source
 * @property integer        $cat_id
 * @property integer        $game_id
 * @property integer        $developer_id
 * @property integer        $topic_id
 * @property string         $game_old
 * @property string         $title
 * @property string         $announce
 * @property string         $text
 * @property integer        $author_id
 * @property integer        $count
 * @property integer        $date
 * @property integer        $pub
 * @property integer        $fs
 *
 * @property ArticleCat     $cat
 * @property Game           $game
 * @property Developer      $developer
 * @property Topic          $topic
 * @property IpbMember      $author
 */
class Article extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles}}';
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
                'when' => function (self $model) {
                    return $model->developer_id === 0 && $model->topic_id === 0;
                }
            ],
            [
                ['game_id', 'developer_id', 'topic_id'],
                'default',
                'value' => 0
            ],
            [
                ['author_id'],
                'default',
                'value' => UserHelper::getUser()->member_id
            ],
            [
                ['date'],
                'default',
                'value' => time()
            ],
            [['cat_id', 'game_id', 'developer_id', 'topic_id', 'author_id', 'count', 'date', 'pub', 'fs'], 'integer'],
            [['announce', 'text'], 'string'],
            [['text'], 'required'],
            [['url', 'source'], 'string', 'max' => 255],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'url'          => Yii::t('app', 'Url'),
            'source'       => Yii::t('app', 'Source'),
            'cat_id'       => Yii::t('app', 'Cat'),
            'game_id'      => Yii::t('app', 'Game'),
            'developer_id' => Yii::t('app', 'Developer'),
            'topic_id'     => Yii::t('app', 'Topic'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'title'        => Yii::t('app', 'Title'),
            'announce'     => Yii::t('app', 'Announce'),
            'text'         => Yii::t('app', 'Text'),
            'author_id'    => Yii::t('app', 'Author'),
            'count'        => Yii::t('app', 'Count'),
            'date'         => Yii::t('app', 'Date'),
            'pub'          => Yii::t('app', 'Pub'),
            'fs'           => Yii::t('app', 'Fs')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(ArticleCat::className(), ['id' => 'cat_id']);
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

    public function getParentUrl()
    {
        $title = 'n/a';
        switch (true) {
            case $this->game_id > 0:
                $title = $this->game->url;
                break;
            case $this->developer_id > 0:
                $title = $this->developer->url;
                break;
            case $this->topic_id > 0:
                $title = $this->topic->url;
                break;
        }

        return $title;
    }

    public function getParentListUrl()
    {
        $url = '#';
        switch (true) {
            case $this->game_id > 0:
                $url = Url::toRoute(['/articles/index/game', 'gameId' => $this->game_id]);
                break;
            case $this->developer_id > 0:
                $url = Url::toRoute(['/articles/index/developer', 'developerId' => $this->game_id]);
                break;
            case $this->topic_id > 0:
                $url = Url::toRoute(['/articles/index/topic', 'topicId' => $this->game_id]);
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
        return Url::toRoute(['/articles/index/author', 'authorId' => $this->author_id]);
    }

    public function getPublicUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/articles/show',
            [
                'parentUrl'  => $this->getParentUrl(),
                'catUrl'     => $this->cat->url,
                'articleUrl' => $this->url
            ], $absolute, true);
    }
}
