<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "housing_estate".
 *
 * @property int $id ID
 * @property string $name Nombre unidad residencial
 * @property string $description Descripción
 * @property string $location Ubicación
 * @property string $address Dirección
 * @property string $phone_number Teléfono portería
 * @property string $police_phone_number Número del cuadrante
 * @property int $city_id
 * @property string $neighborhood Barrio
 * @property int $security_guard_id Portero
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Administrators[] $administrators
 * @property Apartments[] $apartments
 * @property Gates[] $gates
 * @property Cities $city
 * @property Users $securityGuard
 * @property SecurityCameras[] $securityCameras
 */
class HousingEstate extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'housing_estate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'location', 'address', 'city_id', 'neighborhood', 'security_guard_id'], 'required'],
            [['city_id', 'security_guard_id', 'active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name', 'location', 'neighborhood'], 'string', 'max' => 100],
            [['description', 'address'], 'string', 'max' => 255],
            [['phone_number', 'police_phone_number'], 'string', 'max' => 15],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['security_guard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['security_guard_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre unidad residencial',
            'description' => 'Descripción',
            'location' => 'Ubicación',
            'address' => 'Dirección',
            'phone_number' => 'Teléfono portería',
            'police_phone_number' => 'Número del cuadrante',
            'city_id' => 'Ciudad',
            'neighborhood' => 'Barrio',
            'security_guard_id' => 'Portero',
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
    public function getAdministrators() {
        return $this->hasMany(Administrators::className(), ['housing_estate_id' => 'id'])
                        ->andOnCondition(['administrators.active' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments() {
        return $this->hasMany(Apartments::className(), ['housing_estate_id' => 'id'])
                        ->andOnCondition(['apartments.active' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGates() {
        return $this->hasMany(Gates::className(), ['housing_estate_id' => 'id'])
                        ->andOnCondition(['gates.active' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecurityGuard() {
        return $this->hasOne(Users::className(), ['id' => 'security_guard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecurityCameras() {
        return $this->hasMany(SecurityCameras::className(), ['housing_estate_id' => 'id'])
                        ->andOnCondition(['security_cameras.active' => 1]);
    }

}
