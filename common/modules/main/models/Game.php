<?php

namespace bioengine\common\modules\main\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\articles\models\Article;
use bioengine\common\modules\files\models\File;
use bioengine\common\modules\gallery\models\GalleryPic;
use bioengine\common\modules\news\models\News;
use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer   $id
 * @property string    $id_old
 * @property integer   $developer_id
 * @property string    $url
 * @property string    $title
 * @property string    $admin_title
 * @property string    $genre
 * @property string    $release_date
 * @property string    $platforms
 * @property string    $dev
 * @property string    $desc
 * @property string    $keywords
 * @property string    $publisher
 * @property string    $localizator
 * @property integer   $status
 * @property string    $logo
 * @property string    $small_logo
 * @property string    $status_old
 * @property integer   $date
 * @property string    $tweettag
 * @property string    $news_desc
 * @property string    $info
 * @property string    $specs
 * @property string    $ozon
 * @property integer   $rate_pos
 * @property integer   $rate_neg
 * @property string    $voted_users
 *
 * @property Developer $developer
 */
class Game extends BioActiveRecord
{
    public $parentKey = 'game_id';

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
                    'url',
                    'title',
                    'developer_id',
                    'desc',
                    'news_desc'
                ],
                'required'
            ],
            [
                ['logo'],
                'required',
                'when'       => function (self $model) {
                    return $model->logo === '';
                },
                'whenClient' => 'function (attribute, value) { return ' . ($this->logo === '' ? 'true' : 'false') . '; }'
            ],
            [
                ['small_logo'],
                'required',
                'when'       => function (self $model) {
                    return $model->small_logo === '';
                },
                'whenClient' => 'function (attribute, value) { return ' . ($this->small_logo === '' ? 'true' : 'false') . '; }'
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
            [['dev'], 'string', 'max' => 40],
            [['rate_pos', 'rate_neg', 'status'], 'default', 'value' => 0],
            [['ozon', 'specs', 'voted_users'], 'default', 'value' => json_encode([])],
            [['info', 'keywords'], 'default', 'value' => '']
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->date = time();
            }

            return true;
        }

        return false;;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'developer_id' => Yii::t('app', 'Developer'),
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

    /**
     * @return string
     */
    public function getBigLogoUrl()
    {
        return \Yii::$app->params['assets_url'] . \Yii::$app->params['games_images_url'] . 'big/' . $this->logo;
    }

    /**
     * @return string
     */
    public function getSmallLogoUrl()
    {
        return \Yii::$app->params['assets_url'] . \Yii::$app->params['games_images_url'] . 'small/' . $this->small_logo;
    }

    public function getDeveloper()
    {
        return $this->hasOne(Developer::class, ['id' => 'developer_id']);
    }

    public function getPublicUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/games/index/show',
            [
                'gameUrl' => $this->url
            ], $absolute, true);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $logoPath = $this->getLogoPath();
        if ($logoPath) {
            @unlink($logoPath);
        }
        $smallLogoPath = $this->getLogoPath(false);
        if ($smallLogoPath) {
            @unlink($smallLogoPath);
        }
    }

    public function getLogoPath($big = true, $fileName = false)
    {
        $path = \Yii::$app->params['games_images_path'];
        if ($big) {
            if (!$this->logo) {
                return false;
            }
            $path .= '/big/' . ($fileName ?: $this->logo);
        } else {
            if (!$this->small_logo) {
                return false;
            }
            $path .= '/small/' . ($fileName ?: $this->small_logo);
        }

        return $path;
    }

    public function getNewsUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/news/root',
            [
                'gameUrl' => $this->url
            ], $absolute, true);
    }

    public function getGalleryUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/gallery/root',
            [
                'gameUrl' => $this->url
            ], $absolute, true);
    }

    public function getFilesUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/files/root',
            [
                'gameUrl' => $this->url
            ], $absolute, true);
    }

    public function getArticlesUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/articles/root',
            [
                'gameUrl' => $this->url
            ], $absolute, true);
    }

    public function getIcon()
    {
        return $this->getSmallLogoUrl();
    }

    public function getLastArticles($count = 5)
    {
        return Article::find()
            ->where([
                'pub'     => 1,
                'game_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getLastPics($count = 15)
    {
        return GalleryPic::find()
            ->where([
                'pub'     => 1,
                'game_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getLastNews($count = 5)
    {
        return News::find()
            ->where([
                'pub'     => 1,
                'game_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

    public function getLastFiles($count = 5)
    {
        return File::find()
            ->where([
                //  'pub'     => 1,
                'game_id' => $this->id
            ])
            ->limit($count)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }
}
