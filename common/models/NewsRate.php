<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_news_rate".
 *
 * @property integer $id
 * @property integer $news_id
 * @property integer $user_id
 * @property integer $pos
 * @property integer $date
 */
class NewsRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_news_rate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'user_id', 'date'], 'required'],
            [['news_id', 'user_id', 'pos', 'date'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'news_id' => Yii::t('app', 'News ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'pos' => Yii::t('app', 'Pos'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
