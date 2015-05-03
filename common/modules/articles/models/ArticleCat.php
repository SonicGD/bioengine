<?php

namespace bioengine\common\modules\articles\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "articles_cats".
 *
 * @property integer             $id
 * @property integer             $pid
 * @property integer             $game_id
 * @property integer             $developer_id
 * @property integer             $topic_id
 * @property string              $title
 * @property string              $url
 * @property string              $descr
 * @property string              $game_old
 * @property string              $content
 * @property integer             $articles
 *
 * @property Game                $game
 * @property Developer           $developer
 * @property Topic               $topic
 * @property ArticleCat          $parent
 *
 */
class ArticleCat extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id', 'topic_id', 'articles'], 'integer'],
            [['pid'], 'default', 'value' => 0],
            [['content'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
            [['descr'], 'string', 'max' => 100],
            [['game_old'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'pid'          => Yii::t('app', 'Parent Cat'),
            'game_id'      => Yii::t('app', 'Game'),
            'developer_id' => Yii::t('app', 'Developer'),
            'topic_id'     => Yii::t('app', 'Topic'),
            'title'        => Yii::t('app', 'Title'),
            'url'          => Yii::t('app', 'Url'),
            'descr'        => Yii::t('app', 'Descr'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'content'      => Yii::t('app', 'Content'),
            'articles'     => Yii::t('app', 'Articles')
        ];
    }

    public function getListUrl()
    {
        return Url::toRoute(['/articles/cats/list', 'catId' => $this->id]);
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
                $url = Url::toRoute(['/articles/cats/game', 'gameId' => $this->game_id]);
                break;
            case $this->developer_id > 0:
                $url = Url::toRoute(['/articles/cats/developer', 'developerId' => $this->game_id]);
                break;
            case $this->topic_id > 0:
                $url = Url::toRoute(['/articles/cats/topic', 'topicId' => $this->game_id]);
                break;
        }

        return $url;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticleCat::className(), ['id' => 'pid']);
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

    public function getFullUrl()
    {
        $url = '';
        if ($this->pid) {
            $url .= $this->parent->getFullUrl() . '/';
        }
        $url .= $this->url;

        return $url;
    }

    public function getPublicUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/articles/cat',
            [
                'parentUrl' => $this->getParentUrl(),
                'catUrl'    => $this->getFullUrl()
            ], $absolute, true);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            return true;
        }

        return false;
    }

    public function getLastArticles($count = 5)
    {
        return Article::find()
            ->where([
                'pub'    => 1,
                'cat_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getChildren()
    {
        return $this->hasMany(self::className(), ['pid' => 'id']);
    }
}
