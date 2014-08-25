<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 24.08.2014
 * Time: 21:20
 */

namespace bioengine\frontend\controllers;


use bioengine\common\modules\files\models\File;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use bioengine\frontend\components\Controller;
use bioengine\modules\articles\models\Article;
use bioengine\modules\articles\models\ArticleCat;
use yii\web\HttpException;

class ArticlesController extends Controller
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($gameUrl = null)
    {
        $query = Game::find();
        $query->orderBy(['title' => SORT_ASC]);
        if ($gameUrl) {
            $query->andWhere(['url' => $gameUrl]);
        }
        /**
         * @var Game[] $games
         */
        $cats = [];
        $games = $query->all();
        if ($games) {
            $cats = [];
            foreach ($games as $game) {
                $game_cats = ArticleCat::find()->where(['game_id' => $game->id])->orderBy(
                    ['title' => SORT_ASC]
                )->all();
                if ($game_cats) {
                    $cats[$game->title] = $game_cats;
                }
            }
        }
        $devcats = array();

        /**
         * @var Developer[] $developers
         */
        $developers = Developer::find()->orderBy(['name' => SORT_ASC])->all();
        if ($developers) {
            foreach ($developers as $developer) {
                $developer_cats = ArticleCat::find()->where(['developer_id' => $developer->id])->orderBy(
                    ['title' => SORT_ASC]
                )->all();
                if ($developer_cats) {
                    $devcats[$developer->name] = $developer_cats;
                }
            }
        }

        $topcats = array();

        /**
         * @var Topic[] $topics
         */
        $topics = Topic::find()->orderBy(['title' => SORT_ASC])->all();
        if ($topics) {
            foreach ($topics as $topic) {
                $topics_cats = ArticleCat::find()->where(['topic_id' => $topic->id])->orderBy(
                    ['title' => SORT_ASC]
                )->all();
                if ($topics_cats) {
                    $topcats[$topic->title] = $topics_cats;
                }
            }
        }

        $this->render('index', array('gamecats' => $cats, 'devcats' => $devcats, 'topcats' => $topcats));
    }

    public function actionCat($gameUrl, $catUrl, $page = 0)
    {
        if (strpos($catUrl, "/")) {
            $patharr = explode("/", $catUrl);
            $parent = $patharr[count($patharr) - 2];
            $path = $patharr[count($patharr) - 1];
        } else {
            $path = $catUrl;
        }
        $developer = false;
        $topic = false;
        $game = Game::find()->where(['url' => $gameUrl])->one();
        $param = false;
        $value = false;
        if ($game) {
            $param = 'game_id';
            $value = $game->id;
        } else {
            $developer = Developer::find()->where(['url' => $gameUrl])->one();
            if ($developer) {
                $param = 'developer_id';
                $value = $developer->id;
            } else {
                $topic = Topic::find()->where(['url' => $gameUrl])->one();
                if ($topic) {
                    $param = 'topic_id';
                    $value = $topic->id;
                }
            }
        }

        /**
         * @var ArticleCat[] $cats
         * @var ArticleCat   $cat
         */
        $cats = ArticleCat::find()->where(['url' => $path, $param => $value])->all();

        if ($param) {
            if ($cats) {
                $cat = null;
                if (count($cats) > 1) {
                    if (isset($parent)) {
                        foreach ($cats as $tmp) {
                            $parentCat = ArticleCat::find()->where(['url' => $parent, 'id' => $tmp->pid])->one();
                            if ($parentCat) {
                                $cat = $tmp;
                                break;
                            }
                        }
                    }
                } else {
                    $cat = $cats[0];
                }
                if ($cat) {
                    if ($cat->content != "") {
                        $cat->content = File::parseVideo($cat->content);
                        $this->render(
                            "cat_content",
                            array('game' => $game, 'developer' => $developer, 'topic' => $topic, 'cat' => $cat)
                        );
                    } else {
                        if ($page > 0) {
                            $page--;
                        }
                        $query = Article::find();
                        $query->where(['pub' => 1, 'cat_id' => $cat->id]);
                        $query->orderBy(['date' => SORT_ASC]);

                        $count = $query->count();


                        $query->limit(\Yii::$app->params["newsOnPage"]);
                        $query->offset($page * \Yii::$app->params["newsOnPage"]);

                        $articles = $query->all();
                        $this->render(
                            'cat',
                            array(
                                'game'      => $game,
                                'developer' => $developer,
                                'topic'     => $topic,
                                'cat'       => $cat,
                                'articles'  => $articles,
                                'count'     => $count,
                                'page'      => $page
                            )
                        );
                    }
                } else {
                    throw new HttpException(404, 'Страница не найдена');
                }
            } else {
                throw new HttpException(404, 'Страница не найдена');
            }
        } else {
            throw new HttpException(404, 'Страница не найдена');
        }
    }

    public function actionShow($gameUrl = "", $catUrl = "", $articleUrl = "")
    {
        if ($gameUrl && $catUrl && $articleUrl) {
            if (strpos($catUrl, "/")) {
                $patharr = explode("/", $catUrl);
                $catUrl = $patharr[count($patharr) - 1];
            }
            $developer = false;
            $topic = false;
            $query = Article::find();
            if ($this->siteteam) {
                if (!$this->hasRights("pubArticles")) {
                    if ($this->hasRights(
                        "Articles"
                    )
                    ) {
                        $query->where(['pub' => 1])->orWhere(['author_id' => $this->member->member_id]);
                    }
                }
            } else {
                if (!$this->admin) {
                    $query->where(['pub' => 1]);
                }
            }

            $query->andWhere(['url' => $articleUrl]);

            $param = false;
            $value = false;
            $game = Game::find()->where(['url' => $gameUrl])->one();
            if ($game) {
                $param = 'game_id';
                $value = $game->id;
            } else {
                $developer = Developer::find()->where(['url' => $gameUrl])->one();
                if ($developer) {
                    $param = 'developer_id';
                    $value = $developer->id;
                } else {
                    $topic = Topic::find()->where(['url' => $gameUrl])->one();
                    if ($topic) {
                        $param = 'topic_id';
                        $value = $topic->id;
                    }
                }
            }

            if ($param) {
                $query->andWhere([$param => $value]);
                /**
                 * @var Article $article
                 */
                $articles = $query->all();
                if ($articles) {
                    $article = null;
                    if (count($articles) > 1) {
                        foreach ($articles as $tmp) {
                            if ($article) {
                                continue;
                            }
                            if ($article->cat->url == $catUrl) {
                                $article = $tmp;
                            }
                        }
                    } else {
                        $article = $articles[0];
                    }
                    if ($article) {
                        $article->text = File::parseVideo($article->text);
                        $this->render(
                            "show",
                            array('game' => $game, 'developer' => $developer, 'topic' => $topic, 'article' => $article)
                        );
                    } else {
                        throw new HttpException(404, 'Страница не найдена');
                    }
                } else {
                    throw new HttpException(404, 'Страница не найдена');
                }
            } else {
                throw new HttpException(404, 'Страница не найдена');
            }
        } else {
            throw new HttpException(404, 'Страница не найдена');
        }
    }

    public function actionGame($gameUrl = "")
    {
        if ($gameUrl != "") {
            $game = false;
            $developer = false;
            $topic = false;
            $query = ArticleCat::find();
            $query->orderBy("pid, title");

            $param = false;
            $value = false;
            $game = Game::find()->where(['url' => $gameUrl])->one();
            if ($game) {
                $param = 'game_id';
                $value = $game->id;
            } else {
                $developer = Developer::find()->where(['url' => $gameUrl])->one();
                if ($developer) {
                    $param = 'developer_id';
                    $value = $developer->id;
                } else {
                    $topic = Topic::find()->where(['url' => $gameUrl])->one();
                    if ($topic) {
                        $param = 'topic_id';
                        $value = $topic->id;
                    }
                }
            }
            if ($param) {
                $query->where([$param => $value]);
                $cats = $query->all();
                if ($cats) {
                    $arts = array();
                    $count = 0;
                    foreach ($cats as $cat) {
                        $articles = Article::find()->where(['cat_id' => $cat->id])->orderBy('title')->all();
                        if ($articles) {
                            $count += count($articles);
                            $arts[] = array('title' => $cat->fulltitle, 'url' => $cat->fullurl, 'items' => $articles);
                        }
                    }
                    $this->render(
                        "game",
                        array(
                            'game'      => $game,
                            'developer' => $developer,
                            'topic'     => $topic,
                            'arts'      => $arts,
                            'count'     => $count
                        )
                    );
                } else {
                    throw new HttpException(200, 'Нет ни одной статьи');
                }
            }
        } else {
            throw new HttpException(404, 'Страница не найдена');
        }
    }
} 