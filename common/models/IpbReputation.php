<?php

namespace bioengine\common\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "reputation".
 *
 * @property integer $rep_id
 * @property integer $rep_to_id
 * @property integer $rep_by_id
 * @property integer $rep_pos
 * @property integer $rep_neg
 * @property string  $rep_text
 * @property integer $rep_time
 */
class IpbReputation extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reputation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_to_id', 'rep_by_id', 'rep_pos', 'rep_neg', 'rep_time'], 'integer'],
            [['rep_text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_id'    => Yii::t('app', 'Rep ID'),
            'rep_to_id' => Yii::t('app', 'Rep To ID'),
            'rep_by_id' => Yii::t('app', 'Rep By ID'),
            'rep_pos'   => Yii::t('app', 'Rep Pos'),
            'rep_neg'   => Yii::t('app', 'Rep Neg'),
            'rep_text'  => Yii::t('app', 'Rep Text'),
            'rep_time'  => Yii::t('app', 'Rep Time'),
        ];
    }
}
