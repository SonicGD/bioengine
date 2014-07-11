<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_site_team".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $developers
 * @property integer $games
 * @property integer $news
 * @property integer $articles
 * @property integer $files
 * @property integer $gallery
 * @property integer $polls
 * @property integer $tags
 * @property integer $active
 */
class SiteTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_site_team}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id'], 'required'],
            [['member_id', 'developers', 'games', 'news', 'articles', 'files', 'gallery', 'polls', 'tags', 'active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'developers' => Yii::t('app', 'Developers'),
            'games' => Yii::t('app', 'Games'),
            'news' => Yii::t('app', 'News'),
            'articles' => Yii::t('app', 'Articles'),
            'files' => Yii::t('app', 'Files'),
            'gallery' => Yii::t('app', 'Gallery'),
            'polls' => Yii::t('app', 'Polls'),
            'tags' => Yii::t('app', 'Tags'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
