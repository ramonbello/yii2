<?php

namespace backend\controllers;

use Yii;
use common\models\Noticia;
use common\models\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticia model.
     * @param integer $id
     * @param integer $created_by
     * @return mixed
     */
    public function actionView($id, $created_by)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $created_by),
        ]);
    }

    /**
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticia();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

           
             if ($model->save()) {
                Yii::$app->session->setFlash("success", "Acción Realizada !");
            } else {
                Yii::$app->session->setFlash("error", "Error!");
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $created_by
     * @return mixed
     */
    public function actionUpdate($id, $created_by)
    {
        $model = $this->findModel($id, $created_by);

       if ($model->load(Yii::$app->request->post()) && $model->validate()) {

           
             if ($model->save()) {
                Yii::$app->session->setFlash("success", "Acción Realizada !");
            } else {
                Yii::$app->session->setFlash("error", "Error!");
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $created_by
     * @return mixed
     */
    public function actionDelete($id, $created_by)
    {
        $this->findModel($id, $created_by)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $created_by
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $created_by)
    {
        if (($model = Noticia::findOne(['id' => $id, 'created_by' => $created_by])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
