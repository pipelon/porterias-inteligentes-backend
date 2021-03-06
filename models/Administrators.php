<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrators".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $name Nombre administrador/a
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
            [['housing_estate_id', 'name', 'cellphone'], 'required'],
            [['housing_estate_id', 'active'], 'integer'],
            [['startdate', 'enddate', 'created', 'modified'], 'safe'],
            [['name', 'photo'], 'string', 'max' => 255],
            [['cellphone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            //file
            [
                ['file'], 'file',
                'mimeTypes' => [
                    'image/*'
                ],
                'maxSize' => Yii::$app->params['maxSize'] * 1024
            ],
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
            'name' => 'Nombre administrador/a',
            'cellphone' => 'Número de celular',
            'email' => 'Correo electrónico',
            'startdate' => 'Fecha de inicio',
            'enddate' => 'Fecha fin',
            'photo' => 'Foto',
            'active' => 'Activo',
            'file' => 'Imagen',
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
