<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_developer_rate".
 *
 * @property integer $id
 * @property integer $developer_id
 * @property integer $user_id
 * @property integer $pos
 * @property integer $date
 */
class DeveloperRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_developer_rate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['developer_id', 'user_id', 'date'], 'required'],
            [['developer_id', 'user_id', 'pos', 'date'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'pos' => Yii::t('app', 'Pos'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
