<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use yii\rest\ActiveController;

/**
 * Description of ApiController
 *
 * @author fecheverri
 */
class ApiController extends ActiveController {

    public $modelClass = "app\models\HousingEstate";

    public function behaviors() {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS', 'POST'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => false,
            ],
        ];
//        $behaviors['authenticator'] = [
//            'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            'auth' => [$this, 'auth']
//        ];
        return $behaviors;
    }

    protected function verbs() {
        return [
            'view' => ['GET', 'HEAD', 'OPTIONS'],
            'searchapartment' => ['POST', 'OPTIONS'],
            'gates' => ['GET', 'OPTIONS'],
            'accesscard' => ['GET', 'OPTIONS'],
            'login' => ['POST', 'OPTIONS'],
            'logout' => ['POST', 'OPTIONS']
        ];
    }

    public function auth($username, $password) {
//        $user = \app\models\User::findByUsername($username);
//
//        //Si usuario y contraseña no es correcto
//        if (!$user || $user->password !== md5($password)) {
//            throw new \yii\web\HttpException(401);
//        }
//        //Verifico la autorizacion
//        /*$request = \Yii::$app->request;
//        $idUnidadResidencial = $request->get('idUnidadResidencial');
//        $authorization = \app\models\Authorizations::find()
//                ->where([
//                    'user_id' => $user->id,
//                    'housing_estate_id' => $idUnidadResidencial
//                ])
//                ->all();
//        if (!$authorization) {
//            throw new \yii\web\HttpException(401);
//        }*/
//
//        return $user;
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'],
                $actions['create'], $actions['update'],
                $actions['delete']);
        return $actions;
    }

    public function actionIndex() {
        /* return \app\models\HousingEstate::find()
          ->joinWith('city')
          ->where(['housing_estate.active' => 1])
          ->asArray()
          ->all(); */
//        return \app\models\HousingEstate::find()
//                        ->joinWith('city')
//                        ->where(['housing_estate.active' => 1])
//                        ->asArray()
//                        ->all();
        var_dump(\Yii::$app->request);
    }

    public function actionView($user) {

        if (empty($user)) {
            throw new \yii\web\HttpException(404);
        }

        $model = \app\models\SecurityGuards::find()
                ->select("housing_estate_security_guard.housing_estate_id")
                ->leftJoin('housing_estate_security_guard', 'housing_estate_security_guard.security_guard_id = security_guards.id')
                ->where('MD5(user_id)= "' . $user . '"')
                ->asArray()
                ->all();
        $idUnidadResidencial = [];
        foreach ($model as $m) {
            $idUnidadResidencial[] = $m['housing_estate_id'];
        }

        $model = \app\models\HousingEstate::find()
                ->joinWith('apartments')
                ->joinWith('gates')
                ->joinWith('administrators')
                ->joinWith('city')
                ->joinWith('securityCameras')
                ->where([
                    'housing_estate.active' => 1
                ])
                ->andWhere(['in', 'housing_estate.id', $idUnidadResidencial])
                ->asArray()
                ->all();
        if (!$model) {
            throw new \yii\web\HttpException(404);
        }
        return $model;
    }

    public function actionLogin() {
        $username = \Yii::$app->request->getBodyParam('username');
        $password = \Yii::$app->request->getBodyParam('password');

        $user = \app\models\User::findByUsername($username);

        //Si usuario y contraseña no es correcto
        if (!$user || $user->password !== md5($password)) {
            throw new \yii\web\HttpException(401);
        }

        return $user;
    }

    public function actionLogout() {
        if (!\Yii::$app->user->logout()) {
            throw new \yii\web\HttpException(500);
        }
        throw new \yii\web\HttpException(200);
    }

    public function actionSearchapartment() {
        $request = \Yii::$app->request;
        $idUnidadResidencial = $request->get('idUnidadResidencial');
        $search = \Yii::$app->request->getBodyParam('search');

        if (empty($idUnidadResidencial) || empty($search)) {
            throw new \yii\web\HttpException(400);
        }

        $model = \app\models\Apartments::find()
                ->joinWith("residents")
                ->joinWith("pets")
                ->orWhere("MATCH (residents.name, residents.tags, residents.phone) "
                        . "AGAINST ('" . trim($search) . "')")
                ->orWhere("MATCH (pets.name, pets.description) "
                        . "AGAINST ('" . trim($search) . "')")
                ->orWhere("MATCH (apartments.name, apartments.phone_number_1, "
                        . "apartments.phone_number_2, apartments.cellphone_number_1, "
                        . "apartments.cellphone_number_2) AGAINST ('" . trim($search) . "')")
                ->andWhere("apartments.housing_estate_id = " . $idUnidadResidencial)
                ->groupBy(["apartments.id"])
                ->asArray()
                ->all();

        if (!$model) {
            throw new \yii\web\HttpException(404);
        }
        return $model;
    }

    public function actionGates() {
        $request = \Yii::$app->request;        
        $gate_id = $request->get('gate_id');
        $state = $request->get('state');
        $state_description = $request->get('state_description');
        
        if(!isset($gate_id) || !isset($state) || !isset($state_description)){
            throw new \yii\web\HttpException(400);
        }
        
        if($state != 0 && $state != 1){
            throw new \yii\web\HttpException(400);
        }
        
        $model = new \app\models\GatesLogs();
        $model->gate_id = $gate_id;
        $model->state = $state;
        $model->state_description = $state_description;
        $model->created = date('Y-m-d H:i:s');
        if(!$model->save()){
            throw new \yii\web\HttpException(500);
        }
        
        throw new \yii\web\HttpException(200);
    }

    public function actionAccesscard() {        
        $request = \Yii::$app->request;        
        $state = $request->get('state');
        $state_description = $request->get('state_description');
        $card_code = $request->get('card_code');
        
        if(!isset($card_code) || !isset($state) || !isset($state_description)){
            throw new \yii\web\HttpException(400);
        }
        
        if($state != 0 && $state != 1){
            throw new \yii\web\HttpException(400);
        }
        
        $model = new \app\models\CardsLog();
        $model->card_code = $card_code;
        $model->state = $state;
        $model->state_description = $state_description;
        $model->created = date('Y-m-d H:i:s');
        if(!$model->save()){
            throw new \yii\web\HttpException(500);
        }
        
        throw new \yii\web\HttpException(200);
    }

}
