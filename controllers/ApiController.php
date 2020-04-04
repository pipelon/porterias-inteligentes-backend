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
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => false,
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }

    protected function verbs() {
        return [
            'view' => ['GET', 'HEAD', 'OPTIONS'],
            'searchapartment' => ['POST', 'OPTIONS']
        ];
    }

    public function auth($username, $password) {
        $user = \app\models\User::findByUsername($username);

        //Si usuario y contraseña no es correcto
        if (!$user || $user->password !== md5($password)) {
            throw new \yii\web\HttpException(401);
        }
        //Verifico la autorizacion
        $request = \Yii::$app->request;
        $idUnidadResidencial = $request->get('idUnidadResidencial');
        $authorization = \app\models\Authorizations::find()
                ->where([
                    'user_id' => $user->id,
                    'housing_estate_id' => $idUnidadResidencial
                ])
                ->all();
        if (!$authorization) {
            throw new \yii\web\HttpException(401);
        }

        return $user;
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'],
                $actions['create'], $actions['update'],
                $actions['delete']);
        return $actions;
    }

    public function actionIndex() {
        return \app\models\HousingEstate::find()
                        ->joinWith('city')
                        ->where(['housing_estate.active' => 1])
                        ->asArray()
                        ->all();
    }

    public function actionView($idUnidadResidencial) {
        $idUnidad = explode(",", $idUnidadResidencial);
        $model = \app\models\HousingEstate::find()
                ->joinWith('apartments')
                ->joinWith('gates')
                ->joinWith('administrators')
                ->joinWith('city')
                ->joinWith('securityCameras')
                ->where([
                    'housing_estate.active' => 1
                ])
                ->andWhere(['in', 'housing_estate.id', $idUnidad])
                ->asArray()
                ->all();
        if (!$model) {
            throw new \yii\web\HttpException(404);
        }
        return $model;
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

}
