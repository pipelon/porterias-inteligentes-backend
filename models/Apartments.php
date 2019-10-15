<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apartments".
 *
 * @property int $id ID
 * @property int $block_id Bloque
 * @property int $floor Piso
 * @property string $name Nombre
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
 * @property Blocks $block
 * @property Pets[] $pets
 * @property Residents[] $residents
 * @property Vehicles[] $vehicles
 */
class Apartments extends BeforeModel {
    
    public $bloque;
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
            [['block_id', 'floor', 'name', 'phone_number_1'], 'required'],
            [['block_id', 'floor', 'active'], 'integer'],
            [['created', 'modified', 'unidad'], 'safe'],
            [['name'], 'string', 'max' => 5],
            [['phone_number_1', 'phone_number_2', 'cellphone_number_1', 'cellphone_number_2'], 'string', 'max' => 15],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['block_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blocks::className(), 'targetAttribute' => ['block_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'block_id' => 'Bloque/Torre/Cuadra',
            'floor' => 'Piso',
            'name' => 'Nombre',
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
    public function getBlock() {
        return $this->hasOne(Blocks::className(), ['id' => 'block_id']);
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
