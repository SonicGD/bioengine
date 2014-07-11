<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_settings".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $type
 * @property string $desc
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_settings}}';
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'desc' => Yii::t('app', 'Desc'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
