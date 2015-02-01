<?php

namespace bioengine\common\modules\files\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\helpers\ArrayHelper;
use bioengine\common\modules\files\models\File;
use bioengine\common\modules\files\models\FileCat;
use bioengine\common\modules\files\models\search\FileSearch;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * FilesController implements the CRUD actions for File model.
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
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
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
     * Displays a single File model.
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
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new File();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            list($games, $developers) = $this->getSelectValues();

            return $this->render(
                'create',
                [
                    'model'      => $model,
                    'games'      => $games,
                    'developers' => $developers
                ]
            );
        }
    }

    /**
     * Updates an existing File model.
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
            list($games, $developers) = $this->getSelectValues();

            return $this->render(
                'update',
                [
                    'model'      => $model,
                    'games'      => $games,
                    'developers' => $developers
                ]
            );
        }
    }

    /**
     * Deletes an existing File model.
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
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
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

        return array($games, $developers);
    }

    /**
     * @param null $search
     * @param null $id
     * @param null $gameId
     * @param null $developerId
     */
    public function actionCatList($search = null, $id = null, $gameId = null, $developerId = null)
    {
        $out = ['more' => false, 'results' => []];
        $query = FileCat::find();

        if ($gameId) {
            $query->andWhere(['game_id' => $gameId]);
        }
        if ($developerId) {
            $query->andWhere(['developer_id' => $developerId]);
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
