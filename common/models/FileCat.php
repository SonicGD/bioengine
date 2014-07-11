<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_files_cats".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $game_id
 * @property integer $developer_id
 * @property string $game_old
 * @property string $title
 * @property string $descr
 * @property string $url
 */
class FileCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_files_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'game_id', 'developer_id'], 'integer'],
            [['descr'], 'required'],
            [['descr'], 'string'],
            [['game_old'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 50],
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
            'pid' => Yii::t('app', 'Pid'),
            'game_id' => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'game_old' => Yii::t('app', 'Game Old'),
            'title' => Yii::t('app', 'Title'),
            'descr' => Yii::t('app', 'Descr'),
            'url' => Yii::t('app', 'Url'),
        ];
    }
}
