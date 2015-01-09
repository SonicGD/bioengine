<?php

namespace bioengine\common\modules\polls\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "poll".
 *
 * @property string  $poll_id
 * @property string  $question
 * @property integer $startdate
 * @property string  $options
 * @property string  $votes
 * @property integer $num_choices
 * @property integer $multiple
 * @property integer $onoff
 */
class Poll extends BioActiveRecord
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
            'poll_id'     => Yii::t('app', 'Poll'),
            'question'    => Yii::t('app', 'Question'),
            'startdate'   => Yii::t('app', 'Start date'),
            'options'     => Yii::t('app', 'Options'),
            'optionsEdit' => Yii::t('app', 'Options'),
            'votes'       => Yii::t('app', 'Votes'),
            'num_choices' => Yii::t('app', 'Num Choices'),
            'multiple'    => Yii::t('app', 'Multiple'),
            'onoff'       => Yii::t('app', 'Onoff'),
        ];
    }

    public function getOptionsEdit()
    {
        $opts = json_decode($this->options, true);
        $items = [];
        foreach ($opts as $opt) {
            $items[] = $opt['text'];
        }
        return implode(PHP_EOL, $items);
    }
}
