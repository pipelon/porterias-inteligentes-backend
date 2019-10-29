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

    public function actions() {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        $actions['view'] = [
            'class' => 'yii\rest\ViewAction',
            'modelClass' => $this->modelClass,
            'findModel' => [$this, 'findModel']
        ];
        return $actions;
    }

    public function findModel($id) {
        $model = \app\models\HousingEstate::find()
                ->joinWith('apartments')
                ->joinWith('gates')
                ->joinWith('administrators')
                ->joinWith('city')
                ->where([
                    'housing_estate.id' => (int) $id, 
                    'housing_estate.active' => 1
                ])
                ->asArray()
                ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

    public function prepareDataProvider() {
        return \app\models\HousingEstate::find()
                        ->joinWith('city')
                        ->where(['housing_estate.active' => 1])
                        ->asArray()
                        ->all();
    }

}
