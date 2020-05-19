<?php

namespace app\controllers;

use Yii;
use app\models\SecurityGuards;
use app\models\SecurityGuardsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SecurityGuardsController implements the CRUD actions for SecurityGuards model.
 */
class SecurityGuardsController extends Controller {

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
     * Lists all SecurityGuards models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SecurityGuardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SecurityGuards model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SecurityGuards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SecurityGuards();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //BUSCO SI EL USUARIO YA EXISTE
            $isExiste = $model->find()->where(['user_id' => $model->user_id])->count();
            if ((int) $isExiste <= 0) {
                
                $model->save();
                //Ingreso las unidades residenciales
                $this->setUserxHousingEstate($model);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $existe = $model->find()->where(['user_id' => $model->user_id])->one();
                return $this->redirect(['view', 'id' => $existe->id]);
            }            
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Funcion para crear los jefes y analistas de un area
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co
     * @param object $users
     * @param string $type
     */
    private function setUserxHousingEstate($model) {
        foreach ($model->housing_estates as $housing_estate) {
            $userxep = new \app\models\HousingEstateSecurityGuard();
            $userxep->security_guard_id = $model->id;
            $userxep->housing_estate_id = $housing_estate;
            $userxep->save();
        }
    }

    /**
     * Updates an existing SecurityGuards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        //Busco las unidades asociadas
        $model->housing_estates = $beforehousing_estates = array_column(\app\models\HousingEstateSecurityGuard::find()
                        ->select(['housing_estate_id'])
                        ->where(['security_guard_id' => $model->id])
                        ->asArray()
                        ->all(), 'housing_estate_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //si hubo cambios de unidades
            if ($beforehousing_estates != $model->housing_estates) {
                //elimino los jefes actuales
                \app\models\HousingEstateSecurityGuard::deleteAll([
                    'security_guard_id' => $model->id
                ]);
                //creo de nuevo los jefes
                $this->setUserxHousingEstate($model);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SecurityGuards model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        
        if($this->findModel($id)->delete()){
            \app\models\HousingEstateSecurityGuard::deleteAll(['security_guard_id' => $id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SecurityGuards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SecurityGuards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SecurityGuards::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
