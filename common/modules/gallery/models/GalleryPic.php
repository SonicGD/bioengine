<?php

namespace bioengine\common\modules\gallery\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string  $game_old
 * @property integer $cat_id
 * @property integer $game_id
 * @property integer $developer_id
 * @property string  $files
 * @property string  $desc
 * @property integer $author_id
 * @property integer $count
 * @property integer $date
 * @property integer $pub
 */
class GalleryPic extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'game_id', 'developer_id', 'author_id', 'count', 'date', 'pub'], 'integer'],
            [['files', 'desc'], 'string'],
            [['desc'], 'required'],
            [['game_old'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'game_old'     => Yii::t('app', 'Game Old'),
            'cat_id'       => Yii::t('app', 'Cat ID'),
            'game_id'      => Yii::t('app', 'Game ID'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'files'        => Yii::t('app', 'Files'),
            'desc'         => Yii::t('app', 'Desc'),
            'author_id'    => Yii::t('app', 'Author ID'),
            'count'        => Yii::t('app', 'Count'),
            'date'         => Yii::t('app', 'Date'),
            'pub'          => Yii::t('app', 'Pub'),
        ];
    }
}
