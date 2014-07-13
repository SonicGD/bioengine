<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $page
 * @property integer $time
 */
class Activity extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'page', 'time'], 'required'],
            [['user_id', 'time'], 'integer'],
            [['page'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'page'    => Yii::t('app', 'Page'),
            'time'    => Yii::t('app', 'Time'),
        ];
    }
}
