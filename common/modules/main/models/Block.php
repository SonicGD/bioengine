<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "blocks".
 *
 * @property string  $index
 * @property string  $content
 * @property integer $active
 */
class Block extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blocks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index', 'content'], 'required'],
            [['content'], 'string'],
            [['active'], 'integer'],
            [['index'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'index'   => Yii::t('app', 'Index'),
            'content' => Yii::t('app', 'Content'),
            'active'  => Yii::t('app', 'Active'),
        ];
    }
}
