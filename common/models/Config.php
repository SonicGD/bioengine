<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "config".
 *
 * @property integer $site_id
 * @property string $title
 * @property string $url
 * @property string $charset
 * @property string $author
 * @property string $head_copy
 * @property string $keywords
 * @property string $desc
 * @property string $skin
 * @property string $default_module
 * @property string $admin_module
 * @property string $forum
 * @property string $forum_path
 * @property integer $news_forum
 * @property integer $debug
 */
class Config extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keywords', 'desc'], 'required'],
            [['keywords', 'desc'], 'string'],
            [['news_forum', 'debug'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['url', 'head_copy'], 'string', 'max' => 100],
            [['charset'], 'string', 'max' => 20],
            [['author', 'forum', 'forum_path'], 'string', 'max' => 50],
            [['skin', 'default_module', 'admin_module'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site_id' => Yii::t('app', 'Site ID'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'charset' => Yii::t('app', 'Charset'),
            'author' => Yii::t('app', 'Author'),
            'head_copy' => Yii::t('app', 'Head Copy'),
            'keywords' => Yii::t('app', 'Keywords'),
            'desc' => Yii::t('app', 'Desc'),
            'skin' => Yii::t('app', 'Skin'),
            'default_module' => Yii::t('app', 'Default Module'),
            'admin_module' => Yii::t('app', 'Admin Module'),
            'forum' => Yii::t('app', 'Forum'),
            'forum_path' => Yii::t('app', 'Forum Path'),
            'news_forum' => Yii::t('app', 'News Forum'),
            'debug' => Yii::t('app', 'Debug'),
        ];
    }
}
