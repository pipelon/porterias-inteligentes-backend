<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "residents".
 *
 * @property int $id ID
 * @property int $apartment_id Apartamento
 * @property string $name Nombre
 * @property int $sex Sexo
 * @property int $document_type Tipo de documento
 * @property string $document Documento
 * @property string $email Correo electrónico
 * @property string $phone Celular
 * @property string $photo Foto
 * @property string $tags Etiquetas
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Apartments $apartment
 */
class Residents extends BeforeModel {
    
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'residents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['apartment_id', 'name', 'sex', 'document_type', 'document', 'email', 'tags'], 'required'],
            [['file'], 'required', 'on' => 'create'],
            [['apartment_id', 'sex', 'document_type', 'active'], 'integer'],
            [['tags'], 'string'],
            [['created', 'modified', 'file'], 'safe'],
            [['email'], 'string', 'max' => 100],
            [['photo', 'name'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['document'], 'integer'],
            [['phone'], 'integer'],
            //file
            [
                ['file'], 'file', 
                'mimeTypes' => [
                    'image/*'
                ]
            ],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
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
            'sex' => 'Sexo',
            'document_type' => 'Tipo de documento',
            'document' => 'Documento',
            'email' => 'Correo electrónico',
            'phone' => 'Celular',
            'photo' => 'Foto',
            'tags' => 'Etiquetas',
            'active' => 'Activo',
            'file' => 'Foto',
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
