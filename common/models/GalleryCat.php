<?php

namespace bioengine\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "gallery_cats".
 *
 * @property integer $id
 * @property string $game_old
 * @property integer $pid
 * @property integer $game_id
 * @property integer $developer_id
 * @property string $title
 * @property string $desc
 * @property string $url
 */
class GalleryCat extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gallery_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id'], 'integer'],
            [['desc'], 'required'],
            [['desc'], 'string'],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'game_old' => Yii::t('app', 'Game Old'),
            'pid' => Yii::t('app', 'Pid'),
            'game_id' => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'url' => Yii::t('app', 'Url'),
        ];
    }
}
