<?php

namespace bioengine\common\modules\main;

use bioengine\common\BioEngine;
use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;
use bioengine\common\modules\articles\models\ArticleCat;
use bioengine\common\modules\files\models\FileCat;
use bioengine\common\modules\gallery\models\GalleryCat;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use bioengine\common\modules\news\models\News;
use samdark\sitemap\Index;
use samdark\sitemap\Sitemap;
use yii\i18n\PhpMessageSource;

/**
 * Class ArticlesModule
 * @package bioengine\common\modules\main
 */
class MainModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\main\controllers\backend';

    public function bootstrap($app)
    {
        parent::bootstrap($app);
        $games = Game::find()->indexBy('url')->all();
        $developers = Developer::find()->indexBy('url')->all();
        $topics = Topic::find()->indexBy('url')->all();
        BioEngine::getInstance()->setGames($games);
        BioEngine::getInstance()->setDevelopers($developers);
        BioEngine::getInstance()->setTopics($topics);
    }

    public function init()
    {
        parent::init();
        \Yii::setAlias('@mainModule', dirname(__FILE__));
        \Yii::$app->i18n->translations['main*'] = [
            'class'            => PhpMessageSource::className(),
            'basePath'         => '@mainModule/messages',
            'forceTranslation' => true,
            'sourceLanguage'   => 'ru',
            'fileMap'          => [
                'main/developers' => 'developers.php',
            ],
        ];
    }

    /**
     * @return string
     */
    protected function getRulesPath()
    {
        return __DIR__ . "/config/rules.php";
    }

    protected function registerMenu()
    {
        //devs
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/developers',
            [],
            'Список разработчиков'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/developers/create',
            [],
            'Добавить разработчика'
        );
        MenuBuilder::registerMenu(
            'developers',
            'Разработчики',
            $items,
            10,
            'fa-group'
        );
        //games
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/games',
            [],
            'Список игр'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/games/create',
            [],
            'Добавить игру'
        );
        MenuBuilder::registerMenu(
            'games',
            'Игры',
            $items,
            11,
            'fa-gamepad'
        );
        //topics
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/topics',
            [],
            'Список тем'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/topics/create',
            [],
            'Добавить тему'
        );
        MenuBuilder::registerMenu(
            'topics',
            'Темы',
            $items,
            11,
            'fa-comments'
        );
    }

    /**
     * @param string $folder
     * @param string $rootUrl
     */
    public static function generateSiteMap($folder, $rootUrl)
    {

        // create sitemap index file
        $index = new Index($folder . '/sitemap.xml');

        $mainSiteMap = new Sitemap($folder . '/sitemap.main.xml');
        $mainSiteMap->addItem($rootUrl, time(), Sitemap::DAILY, 1);
        $mainSiteMap->write();

        self::fillIndexSitemap($index, $mainSiteMap, $rootUrl);

        //games
        $gamesSitemap = new Sitemap($folder . '/sitemap.games.xml');
        /**
         * @var Game[] $games
         */
        $games = Game::find()->all();
        foreach ($games as $game) {
            $url = $game->getPublicUrl(true);
            if (!$url) {
                continue;
            }
            $gamesSitemap->addItem($url, $game->date, Sitemap::DAILY, 0.9);
        }

        $gamesSitemap->write();

        self::fillIndexSitemap($index, $gamesSitemap, $rootUrl);

        //news
        $newsSitemap = new Sitemap($folder . '/sitemap.news.xml');
        /**
         * @var News[] $allNews
         */
        $allNews = News::find()->where(['pub' => 1])->all();
        foreach ($allNews as $news) {
            $url = $news->getPublicUrl(true);
            if (!$url) {
                continue;
            }
            $newsSitemap->addItem($url, $news->last_change_date, Sitemap::WEEKLY, 0.9);
        }
        $newsSitemap->write();

        self::fillIndexSitemap($index, $newsSitemap, $rootUrl);

        //articles
        $articlesSitemap = new Sitemap($folder . '/sitemap.articles.xml');
        /**
         * @var ArticleCat[] $articleCats
         */
        $articleCats = ArticleCat::find()->all();
        foreach ($articleCats as $articleCat) {
            self::generateArticleCatSitemap($articleCat, $articlesSitemap);
        }
        $articlesSitemap->write();

        self::fillIndexSitemap($index, $articlesSitemap, $rootUrl);


        //files
        $filesSitemap = new Sitemap($folder . '/sitemap.files.xml');
        /**
         * @var FileCat[] $fileCats
         */
        $fileCats = FileCat::find()->all();
        foreach ($fileCats as $fileCat) {
            self::generateFileCatSitemap($fileCat, $filesSitemap);
        }
        $filesSitemap->write();

        self::fillIndexSitemap($index, $filesSitemap, $rootUrl);

        //gallery
        $gallerySitemap = new Sitemap($folder . '/sitemap.gallery.xml');
        /**
         * @var GalleryCat[] $galleryCats
         */
        $galleryCats = GalleryCat::find()->all();
        foreach ($galleryCats as $galleryCat) {
            self::generateGalleryCatSitemap($galleryCat, $gallerySitemap);
        }
        $gallerySitemap->write();

        self::fillIndexSitemap($index, $gamesSitemap, $rootUrl);


        $index->write();
    }

    public static function fillIndexSitemap(Index $index, Sitemap $sitemap, $rootUrl)
    {
        foreach ($sitemap->getSitemapUrls($rootUrl) as $url) {
            $index->addSitemap($url);
        }
    }

    public static function generateArticleCatSitemap(ArticleCat $cat, Sitemap $sitemap)
    {
        $catDate = 0;
        foreach ($cat->getArticles() as $article) {
            if (!$article->pub) {
                continue;
            }
            if ($article->date > $catDate) {
                $catDate = $article->date;
            }
            $url = $article->getPublicUrl(true);
            if (!$url) {
                continue;
            }
            $sitemap->addItem($url, $article->date, Sitemap::WEEKLY, 0.8);
        }

        foreach ($cat->children as $child) {
            self::generateArticleCatSitemap($child, $sitemap);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $url = $cat->getPublicUrl(true);
        $sitemap->addItem($url, $catDate, Sitemap::WEEKLY, 0.7);
    }

    public static function generateFileCatSitemap(FileCat $cat, Sitemap $sitemap)
    {
        $catDate = 0;
        foreach ($cat->files as $file) {
            if ($file->date > $catDate) {
                $catDate = $file->date;
            }

            $url = $file->getPublicUrl(true);

            if (!$url) {
                continue;
            }
            $sitemap->addItem($url, $file->date, Sitemap::WEEKLY, 0.8);
        }

        foreach ($cat->children as $child) {
            self::generateFileCatSitemap($child, $sitemap);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $url = $cat->getPublicUrl(true);
        $sitemap->addItem($url, $catDate, Sitemap::WEEKLY, 0.7);
    }

    public static function generateGalleryCatSitemap(GalleryCat $cat, Sitemap $sitemap)
    {
        $catDate = 0;
        foreach ($cat->pics as $pic) {
            if ($pic->date > $catDate) {
                $catDate = $pic->date;
            }
        }

        foreach ($cat->children as $child) {
            self::generateGalleryCatSitemap($child, $sitemap);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $url = $cat->getPublicUrl(true);
        $sitemap->addItem($url, $catDate, Sitemap::WEEKLY, 0.7);
    }
}
