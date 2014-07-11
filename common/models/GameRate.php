<?php

namespace bioengine\common\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "game_rate".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $user_id
 * @property integer $pos
 * @property integer $date
 */
class GameRate extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game_rate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'user_id', 'date'], 'required'],
            [['game_id', 'user_id', 'pos', 'date'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('app', 'ID'),
            'game_id' => Yii::t('app', 'Game ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'pos'     => Yii::t('app', 'Pos'),
            'date'    => Yii::t('app', 'Date'),
        ];
    }
}
