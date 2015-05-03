<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use Yii;

/**
 * This is the model class for table "nuke_topics".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $url
 * @property string  $logo
 * @property string  $desc
 */
class Topic extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nuke_topics}}'; //TODO: RENAME
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'logo', 'desc'], 'required'],
            [['desc'], 'string'],
            [['title', 'url', 'logo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'url'   => Yii::t('app', 'Url'),
            'logo'  => Yii::t('app', 'Logo'),
            'desc'  => Yii::t('app', 'Desc'),
        ];
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return \Yii::$app->params['assets_url'] . \Yii::$app->params['topics_images_url'] . $this->logo;
    }

    public function getNewsUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/news/topic',
            [
                'topicUrl' => $this->url
            ], $absolute, true);
    }

    public function getIcon()
    {
        return $this->getLogoUrl();
    }
}
