<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "housing_estate".
 *
 * @property int $id ID
 * @property string $name Nombre unidad residencial
 * @property string $description Descripción
 * @property int $city_id Ciudad
 * @property string $location Ubicación
 * @property string $address Dirección
 * @property string $neighborhood Barrio
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
            [['name', 'description', 'city_id', 'location', 'address', 'neighborhood'], 'required'],
            [['city_id', 'active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['name', 'description'], 'filter', 'filter'=>'ucfirst'],
            [['description', 'address'], 'string', 'max' => 255],
            [['location', 'neighborhood'], 'string', 'max' => 100],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'city_id' => 'Ciudad',
            'location' => 'Ubicación',
            'address' => 'Dirección',
            'neighborhood' => 'Barrio',
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
        return $this->hasMany(Administrators::className(), ['housing_estate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments() {
        return $this->hasMany(Apartments::className(), ['housing_estate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGates() {
        return $this->hasMany(Gates::className(), ['housing_estate_id' => 'id']);
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
    public function getSecurityCameras() {
        return $this->hasMany(SecurityCameras::className(), ['housing_estate_id' => 'id']);
    }

}
