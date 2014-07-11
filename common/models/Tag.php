<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tags".
 *
 * @property integer $id
 * @property string  $tag
 * @property integer $count
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
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
            'id'    => Yii::t('app', 'ID'),
            'tag'   => Yii::t('app', 'Tag'),
            'count' => Yii::t('app', 'Count'),
        ];
    }
}
