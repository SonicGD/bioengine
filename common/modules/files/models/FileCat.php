<?php

namespace bioengine\common\modules\files\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use Yii;

/**
 * This is the model class for table "files_cats".
 *
 * @property integer    $id
 * @property integer    $pid
 * @property integer    $game_id
 * @property integer    $developer_id
 * @property string     $game_old
 * @property string     $title
 * @property string     $descr
 * @property string     $url
 *
 * @property Game       $game
 * @property Developer  $developer
 * @property FileCat    $parent
 * @property FileCat[]  $children
 */
class FileCat extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id'], 'integer'],
            [['descr'], 'required'],
            [['descr'], 'string'],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 50],
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
            'pid'          => Yii::t('app', 'Pid'),
            'game_id'      => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'title'        => Yii::t('app', 'Title'),
            'descr'        => Yii::t('app', 'Descr'),
            'url'          => Yii::t('app', 'Url')
        ];
    }

    public function getLastFiles($count = 5)
    {
        return File::find()
            ->where([
                //  'pub'     => 1,
                'cat_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'pid']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::className(), ['pid' => 'id']);
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
        $url .= $this->url;

        return $url;
    }

    public function getPublicUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/files/cat',
            [
                'parentUrl' => $this->getParentUrl(),
                'catUrl'    => $this->getFullUrl()
            ], $absolute, true);
    }
}
