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
 * @property string $city Barrio
 * @property string $neighborhood Barrio
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class HousingEstate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'housing_estate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'address', 'city', 'neighborhood', 'created', 'created_by', 'modified', 'modified_by'], 'required'],
            [['created', 'modified'], 'safe'],
            [['name', 'neighborhood'], 'string', 'max' => 100],
            [['description', 'address'], 'string', 'max' => 255],
            [['city', 'created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'address' => 'Dirección',
            'city' => 'Barrio',
            'neighborhood' => 'Barrio',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }
}
