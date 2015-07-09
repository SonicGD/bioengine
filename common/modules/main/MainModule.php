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

    public static function generateSiteMap($xmlPath)
    {
        $lastReleaseDate = date('Y-m-d', time());
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc>https://www.bioware.ru/</loc>
      <lastmod>{$lastReleaseDate}</lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>
   </url>

EOF;
        //games
        /**
         * @var Game[] $games
         */
        $games = Game::find()->all();
        foreach ($games as $game) {
            $date = date('Y-m-d', $game->date);
            $url = $game->getPublicUrl(true);
            $priority = 0.9;
            if (!$url) {
                continue;
            }
            $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$date}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>{$priority}</priority>
   </url>
EOF;
        }
        //news
        /**
         * @var News[] $allNews
         */
        $allNews = News::find()->where(['pub' => 1])->all();
        foreach ($allNews as $news) {
            $date = date('Y-m-d', $news->last_change_date);
            $url = $news->getPublicUrl(true);
            $priority = 0.9;
            if (!$url) {
                continue;
            }
            $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$date}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>{$priority}</priority>
   </url>
EOF;
        }
        //articles
        /**
         * @var ArticleCat[] $articleCats
         */
        $articleCats = ArticleCat::find()->all();
        foreach ($articleCats as $articleCat) {
            self::generateArticleCatSitemap($articleCat, $xml);
        }
        //files
        /**
         * @var FileCat[] $fileCats
         */
        $fileCats = FileCat::find()->all();
        foreach ($fileCats as $fileCat) {
            self::generateFileCatSitemap($fileCat, $xml);
        }
        //gallery

        /**
         * @var GalleryCat[] $galleryCats
         */
        $galleryCats = GalleryCat::find()->all();
        foreach ($galleryCats as $galleryCat) {
            self::generateGalleryCatSitemap($galleryCat, $xml);
        }

        $xml .= <<<EOF
</urlset>
EOF;
        file_put_contents($xmlPath, $xml);
    }

    public static function generateArticleCatSitemap(ArticleCat $cat, &$xml)
    {
        $catDate = 0;
        foreach ($cat->getArticles() as $article) {
            if (!$article->pub) {
                continue;
            }
            if ($article->date > $catDate) {
                $catDate = $article->date;
            }
            $date = date('Y-m-d', $article->date);
            $url = $article->getPublicUrl(true);
            $priority = 0.8;
            if (!$url) {
                continue;
            }
            $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$date}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>{$priority}</priority>
   </url>
EOF;
        }

        foreach ($cat->children as $child) {
            self::generateArticleCatSitemap($child, $xml);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $catDate = date('Y-m-d', $catDate);
        $url = $cat->getPublicUrl(true);
        $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$catDate}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.7</priority>
   </url>
EOF;
    }

    public static function generateFileCatSitemap(FileCat $cat, &$xml)
    {
        $catDate = 0;
        foreach ($cat->files as $file) {
            if ($file->date > $catDate) {
                $catDate = $file->date;
            }
            $date = date('Y-m-d', $file->date);
            $url = $file->getPublicUrl(true);
            $priority = 0.8;
            if (!$url) {
                continue;
            }
            $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$date}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>{$priority}</priority>
   </url>
EOF;
        }

        foreach ($cat->children as $child) {
            self::generateFileCatSitemap($child, $xml);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $catDate = date('Y-m-d', $catDate);
        $url = $cat->getPublicUrl(true);
        $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$catDate}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.7</priority>
   </url>
EOF;
    }

    public static function generateGalleryCatSitemap(GalleryCat $cat, &$xml)
    {
        $catDate = 0;
        foreach ($cat->pics as $pic) {
            if ($pic->date > $catDate) {
                $catDate = $pic->date;
            }
        }

        foreach ($cat->children as $child) {
            self::generateGalleryCatSitemap($child, $xml);
        }

        if ($catDate === 0) {
            $catDate = time();
        }
        $catDate = date('Y-m-d', $catDate);
        $url = $cat->getPublicUrl(true);
        $xml .= <<<EOF
            <url>
      <loc>{$url}</loc>
      <lastmod>{$catDate}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.7</priority>
   </url>
EOF;
    }
}
