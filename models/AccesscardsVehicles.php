<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accesscards_vehicles".
 *
 * @property string $code Código
 * @property int $vehicle_id Vehículo
 * @property string $description Descripción
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Vehicles $vehicle
 * @property AccesscardsvehiclesLog[] $accesscardsvehiclesLogs
 */
class AccesscardsVehicles extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'accesscards_vehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['code', 'vehicle_id', 'active'], 'required'],
            [['vehicle_id', 'active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['code', 'description', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['code'], 'unique'],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicles::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'code' => 'Código',
            'vehicle_id' => 'Vehículo',
            'description' => 'Descripción',
            'active' => 'Activo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle() {
        return $this->hasOne(Vehicles::className(), ['id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesscardsvehiclesLogs() {
        return $this->hasMany(AccesscardsvehiclesLog::className(), ['accesscard_vehicle_code' => 'code']);
    }

}
