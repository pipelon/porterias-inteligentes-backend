<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pets".
 *
 * @property int $id ID
 * @property int $apartment_id Apartamento
 * @property string $name Nombre
 * @property string $description Descripción
 * @property string $photo Foto 
 * @property int $type Tipo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Apartments $apartment
 */
class Pets extends BeforeModel {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['apartment_id', 'name', 'type'], 'required'],
            [['file'], 'required', 'on' => 'create'],
            [['apartment_id', 'type'], 'integer'],
            [['description'], 'string'],
            [['created', 'modified'], 'safe'],
            [['name', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['photo'], 'string', 'max' => 100],
            //file
            [
                ['file'], 'file',
                'mimeTypes' => [
                    'image/*'
                ]
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
            'name' => 'Nombre',
            'description' => 'Descripción',
            'photo' => 'Foto',
            'type' => 'Tipo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment() {
        return $this->hasOne(Apartments::className(), ['id' => 'apartment_id']);
    }

}
