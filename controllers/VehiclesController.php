<?php

namespace app\controllers;

use Yii;
use app\models\Vehicles;
use app\models\VehiclesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VehiclesController implements the CRUD actions for Vehicles model.
 */
class VehiclesController extends Controller {
    
    public $especial = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "Ñ", " ");
    public $wespecial = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "-");

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vehicles models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VehiclesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehicles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vehicles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Vehicles();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {

            //INSTACIO EL ARCHIVO CARGADO
            if (!$model->file = \yii\web\UploadedFile::getInstance($model, 'file')) {
                Yii::$app->session->setFlash('error', "El archivo no pudo "
                        . "ser cargado. Inténtelo de nuevo.");
                return $this->redirect(['index']);
            }

            //RUTA DE ALMACENAJE LOCAL Y NOMBRE
            $ruta = 'archivos/' . date('YmdHis') . '-'
                    . strtolower(trim(str_replace($this->especial, $this->wespecial, $model->file->baseName))) . '.'
                    . strtolower(trim($model->file->extension));
            if (!@$model->file->saveAs($ruta, false)) {
                Yii::$app->session->setFlash('error', "El archivo no pudo "
                        . "ser guardado. Inténtelo de nuevo.");
                return $this->redirect(['index']);
            }

            //GUARDO LOS DATOS
            $model->photo = $ruta;
            if (!$model->save()) {
                unlink($model->photo);
                Yii::$app->session->setFlash('error', "El archivo no pudo "
                        . "ser cargado. Inténtelo de nuevo.");
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vehicles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //INSTACIO EL ARCHIVO CARGADO
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            if (!is_null($model->file)) {
                //RUTA DE ALMACENAJE LOCAL Y NOMBRE
                $ruta = 'archivos/' . date('YmdHis') . '-'
                        . strtolower(trim(str_replace($this->especial, $this->wespecial, $model->file->baseName))) . '.'
                        . strtolower(trim($model->file->extension));
                if (!@$model->file->saveAs($ruta, false)) {
                    Yii::$app->session->setFlash('error', "El archivo no pudo "
                            . "ser guardado. Inténtelo de nuevo.");
                    return $this->redirect(['index']);
                }
                //GUARDO LOS DATOS
                unlink($model->photo);
                $model->photo = $ruta;
            }

            if (!$model->save()) {                
                Yii::$app->session->setFlash('error', "El archivo no pudo "
                        . "ser cargado. Inténtelo de nuevo.");
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vehicles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $photo = $this->findModel($id);
        unlink($photo->photo);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vehicles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vehicles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
