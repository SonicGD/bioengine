<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string  $name
 * @property string  $title
 * @property string  $type
 * @property string  $desc
 * @property string  $value
 */
class Settings extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'type', 'desc', 'value'], 'required'],
            [['desc', 'value'], 'string'],
            [['name', 'title', 'type'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'name'  => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'type'  => Yii::t('app', 'Type'),
            'desc'  => Yii::t('app', 'Desc'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
