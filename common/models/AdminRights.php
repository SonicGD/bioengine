<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_admins_rights".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $admin
 * @property integer $news
 * @property integer $articles
 * @property integer $files
 * @property integer $gallery
 * @property integer $polls
 * @property integer $admins
 * @property integer $sup
 */
class AdminRights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admins_rights}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'admin', 'news', 'articles', 'files', 'gallery', 'polls', 'admins', 'sup'], 'integer'],
            [['uid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'admin' => Yii::t('app', 'Admin'),
            'news' => Yii::t('app', 'News'),
            'articles' => Yii::t('app', 'Articles'),
            'files' => Yii::t('app', 'Files'),
            'gallery' => Yii::t('app', 'Gallery'),
            'polls' => Yii::t('app', 'Polls'),
            'admins' => Yii::t('app', 'Admins'),
            'sup' => Yii::t('app', 'Sup'),
        ];
    }
}
