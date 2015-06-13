<?php

namespace bioengine\common\modules\gallery\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use Yii;

/**
 * This is the model class for table "gallery_cats".
 *
 * @property integer    $id
 * @property string     $game_old
 * @property integer    $pid
 * @property integer    $game_id
 * @property integer    $developer_id
 * @property string     $title
 * @property string     $desc
 * @property string     $url
 *
 * @property GalleryCat $parent
 * @property Game       $game
 * @property Developer  $developer
 */
class GalleryCat extends BioActiveRecord
{

    const PICS_ON_PAGE = 24;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gallery_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id'], 'integer'],
            [['desc'], 'required'],
            [['desc'], 'string'],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'pid'          => Yii::t('app', 'Pid'),
            'game_id'      => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'title'        => Yii::t('app', 'Title'),
            'desc'         => Yii::t('app', 'Desc'),
            'url'          => Yii::t('app', 'Url'),
        ];
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'pid']);
    }

    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    public function getDeveloper()
    {
        return $this->hasOne(Developer::className(), ['id' => 'developer_id']);
    }

    public function getFullUrl()
    {
        $url = '';
        if ($this->pid) {
            $url .= $this->parent->getFullUrl() . '/';
        }
        $url .= $this->url . '/';

        return $url;
    }

    public function getRootUrl()
    {
        $title = 'n/a';
        switch (true) {
            case $this->game_id > 0:
                $title = $this->game->url;
                break;
            case $this->developer_id > 0:
                $title = $this->developer->url;
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
        }

        return $title;
    }

    public function getPublicUrl($absolute = false, $page = null)
    {
        $params = [
            'parentUrl' => $this->getParentUrl(),
            'catUrl'    => $this->getFullUrl()
        ];
        if ($page) {
            $params['page'] = $page;
        }
        return UrlHelper::createUrl(
            '/gallery/cat',
            $params, $absolute, true);
    }
}
