<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "poll".
 *
 * @property string $poll_id
 * @property string $question
 * @property integer $startdate
 * @property string $options
 * @property string $votes
 * @property integer $num_choices
 * @property integer $multiple
 * @property integer $onoff
 */
class Poll extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%poll}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startdate', 'num_choices', 'multiple', 'onoff'], 'integer'],
            [['options', 'votes'], 'string'],
            [['question'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_id' => Yii::t('app', 'Poll ID'),
            'question' => Yii::t('app', 'Question'),
            'startdate' => Yii::t('app', 'Startdate'),
            'options' => Yii::t('app', 'Options'),
            'votes' => Yii::t('app', 'Votes'),
            'num_choices' => Yii::t('app', 'Num Choices'),
            'multiple' => Yii::t('app', 'Multiple'),
            'onoff' => Yii::t('app', 'Onoff'),
        ];
    }
}
