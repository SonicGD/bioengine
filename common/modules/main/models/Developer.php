<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
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
            [['url', 'name', 'info', 'desc', 'logo', 'location', 'peoples', 'site', 'voted_users'], 'required'],
            [['info', 'desc', 'location', 'peoples', 'voted_users'], 'string'],
            [['found_year', 'rate_pos', 'rate_neg'], 'integer'],
            [['url', 'name', 'logo', 'site'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'url'         => Yii::t('app', 'Url'),
            'name'        => Yii::t('app', 'Name'),
            'info'        => Yii::t('app', 'Info'),
            'desc'        => Yii::t('app', 'Desc'),
            'logo'        => Yii::t('app', 'Logo'),
            'found_year'  => Yii::t('app', 'Found Year'),
            'location'    => Yii::t('app', 'Location'),
            'peoples'     => Yii::t('app', 'Peoples'),
            'site'        => Yii::t('app', 'Site'),
            'rate_pos'    => Yii::t('app', 'Rate Pos'),
            'rate_neg'    => Yii::t('app', 'Rate Neg'),
            'voted_users' => Yii::t('app', 'Voted Users'),
        ];
    }
}
