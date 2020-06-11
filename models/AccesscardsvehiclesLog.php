<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accesscardsvehicles_log".
 *
 * @property int $id ID
 * @property string $accesscard_vehicle_code Tarjeta de acceso
 * @property int $state Estado
 * @property string $state_description Descripción
 * @property string $created Fecha
 *
 * @property AccesscardsVehicles $accesscardVehicleCode
 */
class AccesscardsvehiclesLog extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'accesscardsvehicles_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['accesscard_vehicle_code', 'state', 'state_description', 'created'], 'required'],
            [['state'], 'integer'],
            [['state_description'], 'string'],
            [['created'], 'safe'],
            [['accesscard_vehicle_code'], 'string', 'max' => 45],
            [['accesscard_vehicle_code'], 'exist', 'skipOnError' => true, 'targetClass' => AccesscardsVehicles::className(), 'targetAttribute' => ['accesscard_vehicle_code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'accesscard_vehicle_code' => 'Tarjeta de acceso',
            'state' => 'Estado',
            'state_description' => 'Descripción',
            'created' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesscardVehicleCode() {
        return $this->hasOne(AccesscardsVehicles::className(), ['code' => 'accesscard_vehicle_code']);
    }

}
