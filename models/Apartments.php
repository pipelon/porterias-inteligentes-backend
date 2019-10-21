<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apartments".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $block Bloque
 * @property int $floor Piso
 * @property string $name Apartamento
 * @property string $phone_number_1 Teléfono #1
 * @property string $phone_number_2 Teléfono #2
 * @property string $cellphone_number_1 Celular #1
 * @property string $cellphone_number_2 Celular #2
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property HousingEstate $housingEstate
 * @property Pets[] $pets
 * @property Residents[] $residents
 * @property Vehicles[] $vehicles
 */
class Apartments extends BeforeModel {
    
    public $unidad;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'apartments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'floor', 'name', 'phone_number_1'], 'required'],
            [['housing_estate_id', 'floor', 'active'], 'integer'],
            [['created', 'modified', 'unidad'], 'safe'],
            [['block', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 20],
            [['phone_number_1', 'phone_number_2', 'cellphone_number_1', 'cellphone_number_2'], 'string', 'max' => 15],
            [['housing_estate_id'], 'exist', 'skipOnError' => true, 'targetClass' => HousingEstate::className(), 'targetAttribute' => ['housing_estate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'housing_estate_id' => 'Unidad residencial',
            'block' => 'Bloque',
            'floor' => 'Piso',
            'name' => 'Apartamento',
            'phone_number_1' => 'Teléfono #1',
            'phone_number_2' => 'Teléfono #2',
            'cellphone_number_1' => 'Celular #1',
            'cellphone_number_2' => 'Celular #2',
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
    public function getHousingEstate() {
        return $this->hasOne(HousingEstate::className(), ['id' => 'housing_estate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPets() {
        return $this->hasMany(Pets::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResidents() {
        return $this->hasMany(Residents::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles() {
        return $this->hasMany(Vehicles::className(), ['apartment_id' => 'id']);
    }

}
