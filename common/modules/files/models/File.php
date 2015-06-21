<?php

namespace bioengine\common\modules\files\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\ipb\models\IpbMember;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "files".
 *
 * @property integer   $id
 * @property string    $url
 * @property string    $game_old
 * @property integer   $cat_id
 * @property integer   $game_id
 * @property integer   $developer_id
 * @property string    $title
 * @property string    $desc
 * @property string    $announce
 * @property string    $file
 * @property string    $link
 * @property integer   $size
 * @property integer   $stream
 * @property string    $streamfile
 * @property integer   $yt_status
 * @property string    $yt_title
 * @property string    $yt_url
 * @property string    $yt_id
 * @property integer   $author_id
 * @property integer   $count
 * @property integer   $date
 *
 * @property FileCat   $cat
 * @property Game      $game
 * @property Developer $developer
 * @property IpbMember $author
 */
class File extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['cat_id', 'game_id', 'developer_id', 'size', 'stream', 'yt_status', 'author_id', 'count', 'date'],
                'integer'
            ],
            [['desc', 'announce'], 'string'],
            [['desc', 'announce'], 'default', 'value' => ''],
            [['url', 'title', 'link', 'streamfile', 'yt_url', 'yt_id'], 'string', 'max' => 255],
            [['game_old'], 'string', 'max' => 40],
            [['file'], 'string', 'max' => 50],
            [['yt_title'], 'string', 'max' => 60]
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
            'game_old'     => Yii::t('app', 'Game Old'),
            'cat_id'       => Yii::t('app', 'Cat'),
            'game_id'      => Yii::t('app', 'Game'),
            'developer_id' => Yii::t('app', 'Developer'),
            'title'        => Yii::t('app', 'Title'),
            'desc'         => Yii::t('app', 'Desc'),
            'announce'     => Yii::t('app', 'Announce'),
            'file'         => Yii::t('app', 'File'),
            'link'         => Yii::t('app', 'Link'),
            'size'         => Yii::t('app', 'Size'),
            'stream'       => Yii::t('app', 'Stream'),
            'streamfile'   => Yii::t('app', 'Streamfile'),
            'yt_status'    => Yii::t('app', 'Yt Status'),
            'yt_title'     => Yii::t('app', 'Yt Title'),
            'yt_url'       => Yii::t('app', 'Yt Url'),
            'author_id'    => Yii::t('app', 'Author'),
            'count'        => Yii::t('app', 'Count'),
            'date'         => Yii::t('app', 'Date'),
        ];
    }

    public static function parseVideo($text)
    {
        if (strpos($text, "[video id") !== false) {
            define("VIDEO", true);
        }
        $text = preg_replace("#<p>\s*\[video#i", "[video", $text);
        $text = preg_replace("#video\]\s*(<br \/>)?<\/p>#i", "video]", $text);
        $player_yt = "<a style=\"background:url('" . \Yii::$app->params["site_url"] . "/files/vthumb/$1/') center center no-repeat; display:block; background-size: contain;\" class=\"player\" id=\"mediaplayer$1\" data-id=\"$1\" href=\"$5\"><img style=\"\" src=\"/themes/" . Yii::app()->theme->name . "/img/play_large.png\" alt=\"thumb\" /></a><p style=\"text-align:center\"><a rel=\"external nofollow\" href=\"$4\">РЎРјРѕС‚СЂРµС‚СЊ РЅР° YouTube</a></p>";
        $text = preg_replace("#\[video id\=(([0-9]+)?) uri\=(.*?) yt\=(.*?)\](.*?)\[/video\]#i", $player_yt, $text);
        $player = "<a style=\"background:url('" . \Yii::$app->params["site_url"] . "/files/vthumb/$1/') center center no-repeat; display:block; background-size: contain;\" class=\"player\" id=\"mediaplayer$1\" data-id=\"$1\" href=\"$4\"><img style=\"\" src=\"/themes/" . Yii::app()->theme->name . "/img/play_large.png\" alt=\"thumb\" /></a>";
        $text = preg_replace("#\[video id\=(([0-9]+)?) uri\=(.*?)\](.*?)\[/video\]#i", $player, $text);

        return $text;
    }

    public function getCat()
    {
        return $this->hasOne(FileCat::className(), ['id' => 'cat_id']);
    }

    public function getPublicUrl($absolute = false)
    {
        $url = UrlHelper::createUrl(
            '/files/show',
            [
                'parentUrl' => $this->cat->getParentUrl(),
                'catUrl'    => $this->cat->getFullUrl(),
                'fileUrl'   => $this->url
            ], $absolute, true);

        return $url;
    }

    public function getSizeInMb()
    {
        return round($this->size / 1024 / 1024, 2);
    }

    public function getDownloadUrl($absolute = false)
    {
        $url = UrlHelper::createUrl(
            '/files/download',
            [
                'parentUrl' => $this->cat->getParentUrl(),
                'catUrl'    => $this->cat->getFullUrl(),
                'fileUrl'   => $this->url
            ], $absolute, true);

        return $url;
    }

    public function getDirectUrl($absolute = false)
    {
        return $this->link;
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
        }

        return $parent;

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

    public function getAuthor()
    {
        return $this->hasOne(IpbMember::className(), ['member_id' => 'author_id']);
    }

    public static function getByParent($parentUrl, $catUrl, $fileUrl)
    {
        if ($parentUrl && $catUrl && $fileUrl) {
            if (strpos($catUrl, '/')) {
                $patharr = explode('/', $catUrl);
                $catUrl = $patharr[count($patharr) - 1];
            }
            $developer = false;
            $query = File::find();

            $query->andWhere(['url' => $fileUrl]);

            $param = false;
            $value = false;
            $parent = false;
            $game = Game::find()->where(['url' => $parentUrl])->one();
            if ($game) {
                $param = 'game_id';
                $value = $game->id;
                $parent = $game;
            } else {
                $developer = Developer::find()->where(['url' => $parentUrl])->one();
                if ($developer) {
                    $param = 'developer_id';
                    $value = $developer->id;
                    $parent = $developer;
                }
            }

            if ($param) {
                $query->andWhere([$param => $value]);
                /**
                 * @var File $file
                 */
                $files = $query->all();
                if ($files) {
                    $file = null;
                    if (count($files) > 1) {
                        foreach ($files as $tmp) {
                            if ($file) {
                                continue;
                            }
                            if ($file->cat->url === $catUrl) {
                                $file = $tmp;
                            }
                        }
                    } else {
                        $file = $files[0];
                    }
                    if ($file) {
                        return [$file, $parent, $file->cat];
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * @param $url
     * @return bool|File
     * @throws HttpException
     */
    public static function getByUrl($url)
    {
        $regexp = '/(\w+)\/files\/([a-z0-9_\/]+)\/([a-z0-9_]+)/';
        preg_match($regexp, $url, $matches);
        if ($matches) {
            $parentUrl = $matches[1];
            $catUrl = $matches[2];
            $fileUrl = $matches[3];

            list($file) = static::getByParent($parentUrl, $catUrl, $fileUrl);
            return $file;
        }

        return false;
    }
}
