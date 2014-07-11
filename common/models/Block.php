<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_blocks".
 *
 * @property string $index
 * @property string $content
 * @property integer $active
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_blocks}}';
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
            'index' => Yii::t('app', 'Index'),
            'content' => Yii::t('app', 'Content'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
