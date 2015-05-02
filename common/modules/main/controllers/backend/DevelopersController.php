<?php

namespace bioengine\common\modules\main\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\search\DeveloperSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * DevelopersController implements the CRUD actions for Developer model.
 */
class DevelopersController extends BackendController
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
     * Lists all Developer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeveloperSearch();
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
     * Displays a single Developer model.
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
     * Creates a new Developer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Developer();

        return $this->save($model);

    }

    private function save(Developer $model)
    {
        if ($data = Yii::$app->request->post('Developer', [])) {
            $oldLogo = $model->logo;
            $model->setAttributes($data);
            $file = UploadedFile::getInstance($model, 'logo');
            if ($file) {
                //save file
                $file->saveAs(\Yii::$app->params['developers_images_path'] . $file->name);
                $model->logo = $file->name;
            } else {
                $model->logo = $oldLogo;
            }


            if ($model->validate() && $model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render(
            $model->isNewRecord ? 'create' : 'update',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Updates an existing Developer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        return $this->save($model);
    }

    /**
     * Deletes an existing Developer model.
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
     * Finds the Developer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Developer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Developer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
