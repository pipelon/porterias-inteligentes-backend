<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "housing_estate".
 *
 * @property int $id ID
 * @property string $name Nombre
 * @property string $description Descripción
 * @property string $address Dirección
 * @property string $location Ubicación
 * @property string $city Ciudad
 * @property string $neighborhood Barrio
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Blocks[] $blocks
 * @property Gates[] $gates
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
            [['name', 'description', 'address', 'city', 'neighborhood'], 'required'],
            [['active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['location', 'neighborhood'], 'string', 'max' => 100],
            [['description', 'address', 'name'], 'string', 'max' => 255],
            [['city', 'created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'address' => 'Dirección',
            'location' => 'Ubicación',
            'city' => 'Ciudad',
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
    public function getBlocks() {
        return $this->hasMany(Blocks::className(), ['housing_estate_id' => 'id']);
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
    public function getSecurityCameras() {
        return $this->hasMany(SecurityCameras::className(), ['housing_estate_id' => 'id']);
    }

}
