<?php

namespace bioengine\common\modules\ipb\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "reputation_cache".
 *
 * @property string  $id
 * @property string  $app
 * @property string  $type
 * @property string  $type_id
 * @property integer $rep_points
 * @property string  $rep_like_cache
 */
class IpbReputationCache extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reputation_cache}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app', 'type', 'type_id'], 'required'],
            [['type_id', 'rep_points'], 'integer'],
            [['rep_like_cache'], 'string'],
            [['app', 'type'], 'string', 'max' => 32],
            [
                ['app', 'type', 'type_id'],
                'unique',
                'targetAttribute' => ['app', 'type', 'type_id'],
                'message'         => 'The combination of App, Type and Type ID has already been taken.'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('app', 'ID'),
            'app'            => Yii::t('app', 'App'),
            'type'           => Yii::t('app', 'Type'),
            'type_id'        => Yii::t('app', 'Type ID'),
            'rep_points'     => Yii::t('app', 'Rep Points'),
            'rep_like_cache' => Yii::t('app', 'Rep Like Cache'),
        ];
    }
}
