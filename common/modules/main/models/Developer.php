<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use Yii;

/**
 * This is the model class for table "developers".
 *
 * @property integer $id
 * @property string  $url
 * @property string  $name
 * @property string  $info
 * @property string  $desc
 * @property string  $logo
 * @property integer $found_year
 * @property string  $location
 * @property string  $peoples
 * @property string  $site
 * @property integer $rate_pos
 * @property integer $rate_neg
 * @property string  $voted_users
 */
class Developer extends BioActiveRecord
{
    public $parentKey = 'developer_id';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%developers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name', 'info', 'desc', 'location', 'peoples', 'site'], 'required'],
            [
                ['logo'],
                'required',
                'when'       => function (self $model) {
                    return $model->logo === '';
                },
                'whenClient' => 'function (attribute, value) { return ' . ($this->logo === '' ? 'true' : 'false') . '; }'
            ],
            [['info', 'desc', 'location', 'peoples', 'voted_users'], 'string'],
            [['found_year', 'rate_pos', 'rate_neg'], 'integer'],
            [['url', 'name', 'logo', 'site'], 'string', 'max' => 255],
            //custom
            [['voted_users'], 'default', 'value' => json_encode([])],
            [
                ['site'],
                'url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('main/developers', 'ID'),
            'url'         => Yii::t('main/developers', 'Url'),
            'name'        => Yii::t('main/developers', 'Name'),
            'info'        => Yii::t('main/developers', 'Info'),
            'desc'        => Yii::t('main/developers', 'Desc'),
            'logo'        => Yii::t('main/developers', 'Logo'),
            'found_year'  => Yii::t('main/developers', 'Found Year'),
            'location'    => Yii::t('main/developers', 'Location'),
            'peoples'     => Yii::t('main/developers', 'Peoples'),
            'site'        => Yii::t('main/developers', 'Site'),
            'rate_pos'    => Yii::t('main/developers', 'Rate Pos'),
            'rate_neg'    => Yii::t('main/developers', 'Rate Neg'),
            'voted_users' => Yii::t('main/developers', 'Voted Users'),
        ];
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return \Yii::$app->params['assets_url'] . \Yii::$app->params['developers_images_url'] . $this->logo;
    }

    /**
     * @return string
     */
    public function getLogoPath()
    {
        return \Yii::$app->params['developers_images_path'] . $this->logo;
    }

    public function getNewsUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/site/root',
            [
                'parentUrl' => $this->url
            ], $absolute, true);
    }

    public function getArticlesUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/articles/root',
            [
                'parentUrl' => $this->url
            ], $absolute, true);
    }

    public function getGalleryUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/gallery/root',
            [
                'parentUrl' => $this->url
            ], $absolute, true);
    }

    public function getIcon()
    {
        return $this->getLogoUrl();
    }

    public function getIconSize()
    {
        $path = $this->getLogoPath();
        if (is_file($path)) {
            return filesize($path);
        }
        return 1;
    }

    public function getIconPath()
    {
        return $this->getLogoPath();
    }

    public function getTitle()
    {
        return $this->name; //TODO: Rename name to title
    }
}
