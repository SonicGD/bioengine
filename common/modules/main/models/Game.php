<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property string  $id_old
 * @property integer $developer_id
 * @property string  $url
 * @property string  $title
 * @property string  $admin_title
 * @property string  $genre
 * @property string  $release_date
 * @property string  $platforms
 * @property string  $dev
 * @property string  $desc
 * @property string  $keywords
 * @property string  $publisher
 * @property string  $localizator
 * @property integer $status
 * @property string  $logo
 * @property string  $small_logo
 * @property string  $status_old
 * @property integer $date
 * @property string  $tweettag
 * @property string  $news_desc
 * @property string  $info
 * @property string  $specs
 * @property string  $ozon
 * @property integer $rate_pos
 * @property integer $rate_neg
 * @property string  $voted_users
 */
class Game extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%games}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'developer_id',
                    'desc',
                    'keywords',
                    'localizator',
                    'status',
                    'news_desc',
                    'info',
                    'specs',
                    'ozon',
                    'rate_pos',
                    'rate_neg',
                    'voted_users'
                ],
                'required'
            ],
            [['developer_id', 'status', 'date', 'rate_pos', 'rate_neg'], 'integer'],
            [['desc', 'keywords', 'news_desc', 'info', 'specs', 'ozon', 'voted_users'], 'string'],
            [['id_old'], 'string', 'max' => 10],
            [
                [
                    'url',
                    'title',
                    'release_date',
                    'platforms',
                    'publisher',
                    'localizator',
                    'logo',
                    'small_logo',
                    'status_old',
                    'tweettag'
                ],
                'string',
                'max' => 255
            ],
            [['admin_title'], 'string', 'max' => 8],
            [['genre'], 'string', 'max' => 20],
            [['dev'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'id_old'       => Yii::t('app', 'Id Old'),
            'developer_id' => Yii::t('app', 'Developer ID'),
            'url'          => Yii::t('app', 'Url'),
            'title'        => Yii::t('app', 'Title'),
            'admin_title'  => Yii::t('app', 'Admin Title'),
            'genre'        => Yii::t('app', 'Genre'),
            'release_date' => Yii::t('app', 'Release Date'),
            'platforms'    => Yii::t('app', 'Platforms'),
            'dev'          => Yii::t('app', 'Dev'),
            'desc'         => Yii::t('app', 'Desc'),
            'keywords'     => Yii::t('app', 'Keywords'),
            'publisher'    => Yii::t('app', 'Publisher'),
            'localizator'  => Yii::t('app', 'Localizator'),
            'status'       => Yii::t('app', 'Status'),
            'logo'         => Yii::t('app', 'Logo'),
            'small_logo'   => Yii::t('app', 'Small Logo'),
            'status_old'   => Yii::t('app', 'Status Old'),
            'date'         => Yii::t('app', 'Date'),
            'tweettag'     => Yii::t('app', 'Tweettag'),
            'news_desc'    => Yii::t('app', 'News Desc'),
            'info'         => Yii::t('app', 'Info'),
            'specs'        => Yii::t('app', 'Specs'),
            'ozon'         => Yii::t('app', 'Ozon'),
            'rate_pos'     => Yii::t('app', 'Rate Pos'),
            'rate_neg'     => Yii::t('app', 'Rate Neg'),
            'voted_users'  => Yii::t('app', 'Voted Users'),
        ];
    }
}
