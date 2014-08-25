<?php

namespace bioengine\common\modules\files\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string  $url
 * @property string  $game_old
 * @property integer $cat_id
 * @property integer $game_id
 * @property integer $developer_id
 * @property string  $title
 * @property string  $desc
 * @property string  $announce
 * @property string  $file
 * @property string  $link
 * @property integer $size
 * @property integer $stream
 * @property string  $streamfile
 * @property integer $yt_status
 * @property string  $yt_title
 * @property string  $yt_url
 * @property integer $author_id
 * @property integer $count
 * @property integer $date
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
            [['desc', 'announce'], 'required'],
            [['desc', 'announce'], 'string'],
            [['url', 'title', 'link', 'streamfile', 'yt_url'], 'string', 'max' => 255],
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
            'cat_id'       => Yii::t('app', 'Cat ID'),
            'game_id'      => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
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
            'author_id'    => Yii::t('app', 'Author ID'),
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
        $player_yt = "<a style=\"background:url('" . \Yii::$app->params["site_url"] . "/files/vthumb/$1/') center center no-repeat; display:block; background-size: contain;\" class=\"player\" id=\"mediaplayer$1\" data-id=\"$1\" href=\"$5\"><img style=\"\" src=\"/themes/" . Yii::app(
            )->theme->name . "/img/play_large.png\" alt=\"thumb\" /></a><p style=\"text-align:center\"><a rel=\"external nofollow\" href=\"$4\">РЎРјРѕС‚СЂРµС‚СЊ РЅР° YouTube</a></p>";
        $text = preg_replace("#\[video id\=(([0-9]+)?) uri\=(.*?) yt\=(.*?)\](.*?)\[/video\]#i", $player_yt, $text);
        $player = "<a style=\"background:url('" . \Yii::$app->params["site_url"] . "/files/vthumb/$1/') center center no-repeat; display:block; background-size: contain;\" class=\"player\" id=\"mediaplayer$1\" data-id=\"$1\" href=\"$4\"><img style=\"\" src=\"/themes/" . Yii::app(
            )->theme->name . "/img/play_large.png\" alt=\"thumb\" /></a>";
        $text = preg_replace("#\[video id\=(([0-9]+)?) uri\=(.*?)\](.*?)\[/video\]#i", $player, $text);

        return $text;
    }
}
