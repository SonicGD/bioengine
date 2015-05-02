<?php

namespace bioengine\common\modules\articles\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\helpers\ArrayHelper;
use bioengine\common\modules\articles\models\Article;
use bioengine\common\modules\articles\models\ArticleCat;
use bioengine\common\modules\articles\models\search\ArticleSearch;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * ArticlesController implements the CRUD actions for Article model.
 */
class IndexController extends BackendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider
            ]
        );
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id)
            ]
        );
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            list($games, $developers, $topics) = $this->getSelectValues();

            return $this->render(
                'create',
                [
                    'model'      => $model,
                    'games'      => $games,
                    'developers' => $developers,
                    'topics'     => $topics
                ]
            );
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            list($games, $developers, $topics) = $this->getSelectValues();

            return $this->render(
                'update',
                [
                    'model'      => $model,
                    'games'      => $games,
                    'developers' => $developers,
                    'topics'     => $topics
                ]
            );
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     */
    public function getSelectValues()
    {
        $games = ArrayHelper::map(Game::find()->all(), 'id', 'title');
        ArrayHelper::unShiftAssoc($games, 0, 'Выберите игру');
        $developers = ArrayHelper::map(Developer::find()->all(), 'id', 'name');
        ArrayHelper::unShiftAssoc($developers, 0, 'Выберите разработчика');
        $topics = ArrayHelper::map(Topic::find()->all(), 'id', 'title');
        ArrayHelper::unShiftAssoc($topics, 0, 'Выберите тему');

        return [$games, $developers, $topics];
    }

    /**
     * @param null $search
     * @param null $gameId
     * @param null $developerId
     * @param null $topicId
     */
    public function actionCatList($search = null, $gameId = null, $developerId = null, $topicId = null)
    {
        if ($catId = \Yii::$app->request->getBodyParam('catId', null)) {
            $out = [];
            /**
             * @var ArticleCat $cat
             */
            $cat = ArticleCat::findOne($catId);
            if ($cat) {
                $out = ['id' => $cat->id, 'text' => $cat->title];
            }
        } else {

            $out = ['more' => false, 'results' => []];
            $query = ArticleCat::find();

            if ($gameId) {
                $query->andWhere(['game_id' => $gameId]);
            }
            if ($developerId) {
                $query->andWhere(['developer_id' => $developerId]);
            }
            if ($topicId) {
                $query->andWhere(['topic_id' => $topicId]);
            }
            if ($search) {
                $query->andWhere('title LIKE "%' . $search . '%"');
            }
            $command = $query->createCommand();
            $data = $command->queryAll();
            if ($data) {
                foreach ($data as $entry) {
                    $out['results'][] = ['id' => $entry['id'], 'text' => $entry['title']];
                }
            } else {
                $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
            }
        }
        echo Json::encode($out);
    }
}
