<?php

namespace bioengine\common\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string  $key
 * @property string  $title
 * @property string  $code
 * @property integer $date
 */
class Menu extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'title', 'code', 'date'], 'required'],
            [['code'], 'string'],
            [['date'], 'integer'],
            [['key', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'key'   => Yii::t('app', 'Key'),
            'title' => Yii::t('app', 'Title'),
            'code'  => Yii::t('app', 'Code'),
            'date'  => Yii::t('app', 'Date'),
        ];
    }
}
