<?php

namespace app\controllers;

use Yii;
use app\models\Residents;
use app\models\ResidentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResidentsController implements the CRUD actions for Residents model.
 */
class ResidentsController extends Controller {

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
     * Lists all Residents models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ResidentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Residents model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Residents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Residents();
        //$model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {

            if ($model->file) {
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
            } else {
                $model->photo = "";
            }

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
     * Updates an existing Residents model.
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
                if(file_exists($model->photo)){
                    unlink($model->photo);
                }                
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
     * Deletes an existing Residents model.
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
     * Finds the Residents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Residents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Residents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
