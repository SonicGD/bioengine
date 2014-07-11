<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_tags".
 *
 * @property integer $id
 * @property string $tag
 * @property integer $count
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag', 'count'], 'required'],
            [['count'], 'integer'],
            [['tag'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag' => Yii::t('app', 'Tag'),
            'count' => Yii::t('app', 'Count'),
        ];
    }
}
