<?php

namespace bioengine\common\modules\main\controllers\backend;

use bioengine\common\components\BackendController;
use bioengine\common\helpers\ArrayHelper;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\search\GameSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * GamesController implements the CRUD actions for Game model.
 */
class GamesController extends BackendController
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
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
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
     * Displays a single Game model.
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
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Game();

        $developers = $this->getSelectValues();

        return $this->save($model, $developers);
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $developers = $this->getSelectValues();

        return $this->save($model, $developers);
    }

    /**
     * @param Game        $model
     * @param Developer[] $developers
     * @return string|\yii\web\Response
     */
    private function save(Game $model, array $developers)
    {
        if ($data = Yii::$app->request->post('Game', [])) {
            $oldLogo = $model->logo;
            $oldSmallLogo = $model->small_logo;
            $model->setAttributes($data);
            $file = UploadedFile::getInstance($model, 'logo');
            if ($file) {
                //save file
                $file->saveAs(\Yii::$app->params['games_images_path'] . '/big/' . $file->name);
                $model->logo = $file->name;
            } else {
                $model->logo = $oldLogo;
            }

            $fileSmall = UploadedFile::getInstance($model, 'small_logo');
            if ($fileSmall) {
                //save file
                $fileSmall->saveAs(\Yii::$app->params['games_images_path'] . '/small/' . $fileSmall->name);
                $model->small_logo = $fileSmall->name;
            } else {
                $model->small_logo = $oldSmallLogo;
            }


            if ($model->validate() && $model->save(false)) {
                if ($oldLogo
                    && $oldLogo !== $model->logo
                    && $path = $model->getLogoPath(true, $oldLogo)
                ) {
                    @unlink($path);
                }
                if ($oldSmallLogo
                    && $oldSmallLogo !== $model->small_logo
                    && $path = $model->getLogoPath(false, $oldSmallLogo)
                ) {
                    @unlink($path);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render(
            $model->isNewRecord ? 'create' : 'update',
            [
                'model'      => $model,
                'developers' => $developers
            ]
        );
    }

    /**
     * Deletes an existing Game model.
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
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
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
        $developers = ArrayHelper::map(Developer::find()->all(), 'id', 'name');
        ArrayHelper::unShiftAssoc($developers, 0, 'Выберите разработчика');

        return $developers;
    }
}
