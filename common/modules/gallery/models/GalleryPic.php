<?php

namespace bioengine\common\modules\gallery\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use Imagine\Image\Box;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gallery".
 *
 * @property integer    $id
 * @property string     $game_old
 * @property integer    $cat_id
 * @property integer    $game_id
 * @property integer    $developer_id
 * @property string     $files
 * @property string     $desc
 * @property integer    $author_id
 * @property integer    $count
 * @property integer    $date
 * @property integer    $pub
 *
 * @property Game       $game
 * @property Developer  $developer
 * @property GalleryCat $cat
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

    public function getCat()
    {
        return $this->hasOne(GalleryCat::className(), ['id' => 'cat_id']);
    }


    private $_files = [];

    public function getFiles()
    {
        if (!$this->_files) {
            $this->_files = unserialize($this->files);
        }

        return $this->_files;
    }

    public function getFullUrl()
    {
        return $this->getFileUrl(0);
    }

    public function getFileName($fileNumber = 0)
    {
        return $this->getFiles()[$fileNumber]['name'];
    }

    public function getFileUrl($fileNumber)
    {
        $fileName = $this->getFileName($fileNumber);

        return \Yii::$app->params['images_url'] . '/' . $this->getRootUrl() . '/' . $this->cat->getFullUrl() . $fileName;
    }

    public function getFilePath($fileNumber)
    {
        $fileName = $this->getFiles()[$fileNumber]['name'];

        return $this->cat->getPath() . DIRECTORY_SEPARATOR . $fileName;
    }

    public function getRootUrl()
    {
        $title = 'n/a';
        switch (true) {
            case $this->game_id > 0:
                $title = $this->game->url;
                break;
            case $this->developer_id > 0:
                $title = $this->developer->url;
                break;
        }

        return $title;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeveloper()
    {
        return $this->hasOne(Developer::className(), ['id' => 'developer_id']);
    }

    public function getPublicUrl($absolute = false)
    {
        $position = $this->getPosition();
        $page = ceil($position / GalleryCat::PICS_ON_PAGE);
        $catUrl = $this->cat->getPublicUrl($absolute, $page);
        return $catUrl;
    }

    /**
     * @return int|string
     */
    public function getPosition()
    {
        return self::find()->where(['cat_id' => $this->cat_id, 'pub' => $this->pub])->andWhere([
            '>',
            'id',
            $this->id
        ])->orderBy(['id' => SORT_DESC])->count();
    }

    public function getThumbUrl($width, $height, $index = 0)
    {
        $filePath = $this->getFilePath($index);

        if (!is_file($filePath)) {
            return '#';
        }

        $dir = dirname($filePath) . DIRECTORY_SEPARATOR . 'thumb';

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);


        $thumbPath = $dir . DIRECTORY_SEPARATOR . $this->id . '_' . $width . '_' . $height . '_' . $index . '.' . $ext;

        if (!is_file($thumbPath)) {
            $this->createThumb($thumbPath, $width, $height, $index);
        }
        $thumbUrl = str_ireplace(\Yii::$app->params['images_path'], \Yii::$app->params['images_url'], $thumbPath);
        return $thumbUrl;
    }

    private function createThumb($thumbPath, $width, $height, $index = 0)
    {
        $filePath = $this->getFilePath($index);

        if (!is_dir(dirname($thumbPath))) {
            mkdir(dirname($thumbPath));
        }

        $size = getimagesize($filePath);
        $origHeight = $size[1];
        $origWidth = $size[0];
        $newWidth = $width;
        $newHeight = $height;
        if ($height > 0) {
            if ($origWidth > $origHeight) {
                $ratio = $origWidth / $origHeight;
                //echo "ratio: ".$ratio."<br />";
                $newHeight = $width / $ratio;
                //echo "newHeight: ".$newHeight."<br />";
                if ($newHeight > $height) {
                    $hratio = $newHeight / $height;
                    $newWidth /= $hratio;
                    $newHeight = $height;
                }
            } elseif ($origHeight > $origWidth) {
                $ratio = $origHeight / $origWidth;
                //echo "ratio: ".$ratio;
                $newWidth = $height / $ratio;
                if ($newWidth > $width) {
                    $wratio = $newWidth / $width;
                    $newHeight /= $wratio;
                    $newWidth = $width;
                }
            }
        } else {
            $ratio = $origWidth / $origHeight;
            //echo "ratio: ".$ratio."<br />";
            $newHeight = $width / $ratio;
            //echo "newHeight: ".$newHeight."<br />";
        }

        $image = Image::getImagine()->open($filePath);
        $image->resize(new Box($newWidth, $newHeight));
        $image->save($thumbPath);

        return $thumbPath;
    }
}
