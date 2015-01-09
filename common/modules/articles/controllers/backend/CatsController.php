<?php

namespace bioengine\common\modules\articles\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\helpers\ArrayHelper;
use bioengine\common\modules\articles\models\ArticleCat;
use bioengine\common\modules\articles\models\search\ArticleCatSearch;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * ArticlesCatsController implements the CRUD actions for Article model.
 */
class CatsController extends BackendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ArticleCat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleCatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single ArticleCat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new ArticleCat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleCat();

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
     * Updates an existing ArticleCat model.
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
     * Deletes an existing ArticleCat model.
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
     * Finds the ArticleCat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleCat::findOne($id)) !== null) {
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
        return array($games, $developers, $topics);
    }

    /**
     * @param null $search
     * @param null $id
     * @param null $gameId
     * @param null $developerId
     * @param null $topicId
     */
    public function actionCatList($search = null, $id = null, $gameId = null, $developerId = null, $topicId = null)
    {
        $out = ['more' => false, 'results' => []];
        $query = ArticleCat::find();

        if ($gameId) {
            $query->andWhere(['game_id' => $gameId]);
        }
        if ($developerId) {
            $query->andWhere(['topic_id' => $developerId]);
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
        echo Json::encode($out);
    }
}
