<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrators".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $name Nombres
 * @property string $cellphone Número de celular
 * @property string $email Correo electrónico
 * @property string $startdate Fecha de inicio
 * @property string $enddate Fecha fin
 * @property string $photo Foto
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property HousingEstate $housingEstate
 */
class Administrators extends BeforeModel {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'administrators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'name', 'cellphone', 'email', 'photo'], 'required'],
            [['housing_estate_id', 'active'], 'integer'],
            [['file'], 'required', 'on' => 'create'],
            [['startdate', 'enddate'], 'safe'],
            [['name', 'created', 'created_by', 'modified', 'modified_by'], 'string', 'max' => 45],
            [['cellphone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 255],
            //file
            [
                ['file'], 'file',
                'mimeTypes' => [
                    'image/*'
                ]
            ],
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
            'name' => 'Nombres',
            'cellphone' => 'Número de celular',
            'email' => 'Correo electrónico',
            'startdate' => 'Fecha de inicio',
            'enddate' => 'Fecha fin',
            'photo' => 'Foto',
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

}
