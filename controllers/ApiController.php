<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use yii\rest\ActiveController;
use yii\httpclient\Client;

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
        
    }

    /**
     * Funcion para ver todas las unidades que maneja el portero
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co 
     * @param string $user
     * @return HousingEstate
     */
    public function actionView($user) {
        //VALIDO QUE EL PARAMETRO DE ENTRADA NO ESTE VACIO
        if (empty($user)) {
            throw new \yii\web\HttpException(404);
        }
        //OBTENGA LAS UNIDADES QUE MANEJA EL PORTERO
        $model = \app\models\HousingEstate::find()
                ->where('MD5(security_guard_id)= "' . $user . '"')
                ->asArray()
                ->all();
        $idUnidadResidencial = [];
        foreach ($model as $m) {
            $idUnidadResidencial[] = $m['id'];
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

    /**
     * Funcion para realizar el login al sistema
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co  
     * @return type
     * @throws \yii\web\HttpException
     */
    public function actionLogin() {
        $username = \Yii::$app->request->getBodyParam('username');
        $password = \Yii::$app->request->getBodyParam('password');

        $user = \app\models\User::findByUsername($username);

        //Si usuario y contraseña no es correcto
        if (!$user || $user->password !== md5($password)) {
            throw new \yii\web\HttpException(401);
        }

        //BUSCO QUE EL USUARIO SEA UN PORTERO Y ESTÉ ACTIVO
        $isPorteroActivo = $this->isPortero(md5($user->id));

        if (empty($isPorteroActivo)) {
            throw new \yii\web\HttpException(401);
        }

        return $user;
    }

    /**
     * Funcion para el logout del portero
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co   
     * @throws \yii\web\HttpException
     */
    public function actionLogout() {
        if (!\Yii::$app->user->logout()) {
            throw new \yii\web\HttpException(500);
        }
        throw new \yii\web\HttpException(200);
    }

    /**
     * Funcion para buscar un apartamento
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co   
     * @return type
     * @throws \yii\web\HttpException
     */
    public function actionSearchapartment() {
        //PARAMENTROS DE ENTRADA
        $request = \Yii::$app->request;
        $idUnidadResidencial = \Yii::$app->request->getBodyParam('housingEstateID');
        $search = \Yii::$app->request->getBodyParam('search');
        $user_id = $request->get('user');

        //VALIDO QUE LOS PARAMETROS DE ENTRADA EXISTAN Y NO ESTEN VACIOS
        if (empty($idUnidadResidencial) || empty($search)) {
            throw new \yii\web\HttpException(400);
        }

        //VALIDO QUE EL USUARIO SEA PORTERO Y ESTE ACTIVO
        $isPorteroActivo = $this->isPortero($user_id);
        if (empty($isPorteroActivo)) {
            throw new \yii\web\HttpException(401);
        }

        //VALIDO QUE EL USUARIO SI MANEJE ESTA UNIDAD
        $isValid = \app\models\HousingEstate::find()
                ->where(['id' => $idUnidadResidencial])
                ->andWhere('MD5(security_guard_id)= "' . $user_id . '"')
                ->count();

        if ((int) $isValid <= 0) {
            throw new \yii\web\HttpException(401);
        }

        //BUSCO EL APARTAMENTO
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
            throw new \yii\web\HttpException(404, 'No encontrado.');
        }
        return $model;
    }

    /**
     * Funcion para validar apertura de puertas
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co   
     * @throws \yii\web\HttpException
     */
    public function actionGates() {
        $request = \Yii::$app->request;
        $gate_id = $request->get('gate_id');
        $state = $request->get('state');
        $state_description = $request->get('state_description');

        if (!isset($gate_id) || !isset($state) || !isset($state_description)) {
            throw new \yii\web\HttpException(400);
        }

        if ($state != 0 && $state != 1) {
            throw new \yii\web\HttpException(400);
        }

        $model = new \app\models\GatesLogs();
        $model->gate_id = $gate_id;
        $model->state = $state;
        $model->state_description = $state_description;
        $model->created = date('Y-m-d H:i:s');
        if (!$model->save()) {
            throw new \yii\web\HttpException(500);
        }

        //OBTENGO LA INFO DE LA UNIDAD, LA PUERTA Y EL USUARIO
        $sql = "SELECT gates_logs.state_description, `gates`.`name` as gate, 
            `housing_estate`.`name` as housing_state, security_guards.user_id,
            gates_logs.created
            FROM `gates_logs` LEFT JOIN `gates` ON gates.id = gates_logs.gate_id 
            LEFT JOIN `housing_estate` ON housing_estate.id = gates.housing_estate_id 
            LEFT JOIN `housing_estate_security_guard` ON housing_estate_security_guard.housing_estate_id = housing_estate.id
            LEFT JOIN `security_guards` ON security_guards.id = housing_estate_security_guard.security_guard_id
            WHERE `gates_logs`.`id`=" . $model->id;
        $command = \Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();

        //ENVIO EL MENSAJE AL CLIENTE
        $client = new Client();
        $response = $client->createRequest()
                ->setMethod("POST")
                ->setUrl(\Yii::$app->params['urlServiceSocket'] . '/alertas_generales')
                ->setHeaders([
                    "Content-Type" => "application/json"
                ])
                ->setData([
                    "userId" => $result["user_id"],
                    "housingEstate" => $result["housing_state"],
                    "message" => "(" . $result["gate"] . "): " . $result["state_description"],
                    "date" => $result["created"]
                ])
                ->send();

        if (!$response->isOk) {
            throw new \yii\web\HttpException(500);
        }

        throw new \yii\web\HttpException(200);
    }

    /**
     * Funcion para validar acceso de tarjeta RFID
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co  
     * @throws \yii\web\HttpException
     */
    public function actionAccesscard() {
        //CODIGO DE LA TARJETA
        $request = \Yii::$app->request;
        $card_code = $request->get('card_code');

        //VALIDO QUE SE TNGA EL COGIDO DE LA TARJETA
        if (!isset($card_code) || empty($card_code)) {
            throw new \yii\web\HttpException(400, "Se esperaba un código de tarjeta");
        }

        //VALIDO QUE LA TARJETA ESTE ACTIVA
        $isValidCard = \app\models\Accesscards::find()
                ->where([
                    'code' => $card_code,
                    'active' => 1
                ])
                ->count();
        if ((int) $isValidCard <= 0) {
            $msg = "La tarjeta: '" . $card_code . "' no existe o no está activa";
            $this->setLogAccessCard(2, $msg);
            throw new \yii\web\HttpException(500, $msg);
        }

        //VALIDO QUE EL PROPIETARIO DE LA TARJETA ESTE ACTIVO
        $isValidResident = \app\models\Residents::find()
                ->joinWith('accesscards')
                ->where([
                    'residents.active' => 1,
                    'accesscards.code' => $card_code,
                ])
                ->count();
        if ((int) $isValidResident <= 0) {
            $msg = "El usuario propietario de la tarjeta: '" . $card_code . "' no existe o no está activo";
            $this->setLogAccessCard(2, $msg);
            throw new \yii\web\HttpException(500, $msg);
        }

        //OBTENGO LA INFORMACIÓN COMPLETA DE LA UNIDAD, APARTAMENTO, USUARIO        
        $info = \app\models\Accesscards::findOne($card_code);

        $msg = "Acceso peatonal con Tarjeta: '" . $card_code . "'"
                . ", Residente: '" . $info->resident->name . "'"
                . ", Apartamento: '" . $info->resident->apartment->name . "'"
                . ", Unidad: '" . $info->resident->apartment->housingEstate->name . "'.";
        $this->setLogAccessCard(1, $msg, $card_code);

        //OBTENGO EL ID DEL PORTERO QUE MANEJA LA UNIDAD
        $unidad = \app\models\HousingEstate::find()
                ->where(['id' => $info->resident->apartment->housingEstate->id])
                ->one();

        //ENVIO EL MENSAJE AL CLIENTE
        $response = $this->setAlertSocket($unidad->security_guard_id, $info->resident->apartment->housingEstate->name, $msg);

        if (!$response->isOk) {
            throw new \yii\web\HttpException(500, "No se pudo enviar la alerta al portero.");
        }

        throw new \yii\web\HttpException(200, $msg);
    }
    
    /**
     * Funcion para validar acceso de tarjeta RFID
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co  
     * @throws \yii\web\HttpException
     */
    public function actionAccesscardvehicle() {
        //CODIGO DE LA TARJETA
        $request = \Yii::$app->request;
        $card_code = $request->get('card_code');

        //VALIDO QUE SE TNGA EL COGIDO DE LA TARJETA
        if (!isset($card_code) || empty($card_code)) {
            throw new \yii\web\HttpException(400, "Se esperaba un código de tarjeta");
        }

        //VALIDO QUE LA TARJETA ESTE ACTIVA
        $isValidCard = \app\models\AccesscardsVehicles::find()
                ->where([
                    'code' => $card_code,
                    'active' => 1
                ])
                ->count();
        if ((int) $isValidCard <= 0) {
            $msg = "La tarjeta: '" . $card_code . "' no existe o no está activa";
            $this->setLogAccessCardVehicle(2, $msg);
            throw new \yii\web\HttpException(500, $msg);
        }       

        //OBTENGO LA INFORMACIÓN COMPLETA DE LA UNIDAD, APARTAMENTO, USUARIO        
        $info = \app\models\AccesscardsVehicles::findOne($card_code);

        $msg = "Acceso vehicular con Tarjeta: '" . $card_code . "'"
                . ", Vehículo tipo: '" . \Yii::$app->params['vehicle_type'][$info->vehicle->type] . "'"
                . ", Placa: '" . $info->vehicle->license_plate . "'"
                . ", Apartamento: '" . $info->vehicle->apartment->name . "'"
                . ", Unidad: '" . $info->vehicle->apartment->housingEstate->name . "'.";
        $this->setLogAccessCardVehicle(1, $msg, $card_code);

        //OBTENGO EL ID DEL PORTERO QUE MANEJA LA UNIDAD
        $unidad = \app\models\HousingEstate::find()
                ->where(['id' => $info->vehicle->apartment->housingEstate->id])
                ->one();

        //ENVIO EL MENSAJE AL CLIENTE
        $response = $this->setAlertSocket($unidad->security_guard_id, $info->vehicle->apartment->housingEstate->name, $msg);

        if (!$response->isOk) {
            throw new \yii\web\HttpException(500, "No se pudo enviar la alerta al portero.");
        }

        throw new \yii\web\HttpException(200, $msg);
    }

    /**
     * Funcion que valida si el usuario es un portero y esta activo
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co   
     * @param string $user_id
     * @return type
     */
    private function isPortero($user_id) {
        return \app\models\Users::find()
                        ->innerJoin('auth_assignment', 'auth_assignment.user_id = users.id')
                        ->innerJoin('housing_estate', 'housing_estate.security_guard_id = users.id')
                        ->where(
                                [
                                    'users.active' => 1,
                                    'auth_assignment.item_name' => 'Portero',
                                    'housing_estate.active' => 1
                                ]
                        )
                        ->andWhere('MD5(users.id)= "' . $user_id . '"')
                        ->all();
    }

    /**
     * Funcion para guardar en el log de tarjetas de acceso
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co    
     * @param int $state
     * @param string $message
     * @param string $card_code
     */
    private function setLogAccessCard($state, $message, $card_code = null) {
        $model = new \app\models\AccesscardsLog();
        $model->card_code = $card_code;
        $model->state = $state;
        $model->state_description = $message;
        $model->created = date('Y-m-d H:i:s');
        $model->save();
    }
    
    /**
     * Funcion para guardar en el log de tarjetas de acceso de lo vehiculos
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co    
     * @param int $state
     * @param string $message
     * @param string $card_code
     */
    private function setLogAccessCardVehicle($state, $message, $card_code = null) {
        $model = new \app\models\AccesscardsvehiclesLog();
        $model->accesscard_vehicle_code = $card_code;
        $model->state = $state;
        $model->state_description = $message;
        $model->created = date('Y-m-d H:i:s');
        $model->save();
    }
    
    /**
     * Funcion para enviar la alerta al portero por socket
     * 
     * @author Felipe Echeverri <pipe.echeverri.1@gmail.com.co>
     * @copyright 2020 ONICSFOT
     * @link http://www.onicsoft.com.co   
     * @param int $security_guard_id
     * @param string $housingEstate
     * @param string $msg
     * @return Client
     */
    private function setAlertSocket($security_guard_id, $housingEstate, $msg) {
        $client = new Client();
        return $client->createRequest()
                        ->setMethod("POST")
                        ->setUrl(\Yii::$app->params['urlServiceSocket'] . '/alertas_generales')
                        ->setHeaders([
                            "Content-Type" => "application/json"
                        ])
                        ->setData([
                            "userId" => $security_guard_id,
                            "housingEstate" => $housingEstate,
                            "message" => $msg,
                            "date" => date('Y-m-d H:i:s')
                        ])
                        ->send();
    }

}
