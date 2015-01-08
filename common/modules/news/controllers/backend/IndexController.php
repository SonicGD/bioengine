<?php

namespace bioengine\common\modules\news\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use bioengine\common\modules\news\models\News;
use bioengine\common\modules\news\models\search\NewsSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * NewsController implements the CRUD actions for News model.
 */
class IndexController extends BackendController
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
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
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $games = ArrayHelper::map(Game::find()->all(), 'id', 'title');
            $developers = ArrayHelper::map(Developer::find()->all(), 'id', 'name');
            $topics = ArrayHelper::map(Topic::find()->all(), 'id', 'title');
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
     * Updates an existing News model.
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
            $games = ArrayHelper::map(Game::find()->all(), 'id', 'title');
            $developers = ArrayHelper::map(Developer::find()->all(), 'id', 'name');
            $topics = ArrayHelper::map(Topic::find()->all(), 'id', 'title');
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
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
