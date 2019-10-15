<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blocks".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $name Nombre
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Apartments[] $apartments
 * @property HousingEstate $housingEstate
 */
class Blocks extends BeforeModel {
    
    public $unidad;
    public $bloque;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'name'], 'required'],
            [['housing_estate_id'], 'integer'],
            [['created', 'modified', 'unidad', 'bloque'], 'safe'],
            [['name', 'created_by', 'modified_by'], 'string', 'max' => 45],
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
            'name' => 'Nombre',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments() {
        return $this->hasMany(Apartments::className(), ['block_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHousingEstate() {
        return $this->hasOne(HousingEstate::className(), ['id' => 'housing_estate_id']);
    }

}
