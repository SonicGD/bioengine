<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "nuke_topics".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $url
 * @property string  $logo
 * @property string  $desc
 */
class Topic extends ActiveRecord
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
}
