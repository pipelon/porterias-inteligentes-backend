<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gates".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $name Puerta
 * @property string $location Ubicación
 * @property int $state Estado
 * @property string $state_description Descripción de estado
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property FlyPass[] $flyPasses
 * @property HousingEstate $housingEstate
 * @property GatesLogs[] $gatesLogs
 * @property OpeningSensors[] $openingSensors
 * @property VideoDoorman[] $videoDoormen
 */
class Gates extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'gates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'name', 'location', 'created', 'created_by', 'modified', 'modified_by'], 'required'],
            [['housing_estate_id', 'state', 'active'], 'integer'],
            [['state_description'], 'string'],
            [['created', 'modified'], 'safe'],
            [['name', 'location'], 'string', 'max' => 255],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
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
            'name' => 'Puerta',
            'location' => 'Ubicación',
            'state' => 'Estado',
            'state_description' => 'Descripción de estado',
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
    public function getFlyPasses() {
        return $this->hasMany(FlyPass::className(), ['gate_id' => 'id']);
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
    public function getGatesLogs() {
        return $this->hasMany(GatesLogs::className(), ['gate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpeningSensors() {
        return $this->hasMany(OpeningSensors::className(), ['gate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoDoormen() {
        return $this->hasMany(VideoDoorman::className(), ['gate_id' => 'id']);
    }

}
