<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicles".
 *
 * @property int $id ID
 * @property int $apartment_id Apartamento
 * @property string $photo Foto
 * @property string $license_plate Placa
 * @property int $type Tipo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property AccesscardsVehicles[] $accesscardsVehicles
 * @property Apartments $apartment
 */
class Vehicles extends BeforeModel {
    
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'vehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['apartment_id', 'license_plate', 'type'], 'required'],
            [['apartment_id', 'type'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['photo'], 'string', 'max' => 255],
            [['license_plate'], 'string', 'max' => 10],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            //file
            [
                ['file'], 'file',
                'mimeTypes' => [
                    'image/*'
                ],
                'maxSize' => Yii::$app->params['maxSize'] * 1024
            ],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartments::className(), 'targetAttribute' => ['apartment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'apartment_id' => 'Apartamento',
            'photo' => 'Foto',
            'license_plate' => 'Placa',
            'type' => 'Tipo',
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
    public function getAccesscardsVehicles() {
        return $this->hasMany(AccesscardsVehicles::className(), ['vehicle_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment() {
        return $this->hasOne(Apartments::className(), ['id' => 'apartment_id']);
    }

}
