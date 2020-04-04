<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "security_cameras".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property string $name Nombre de la cámara
 * @property string $description Descripción
 * @property string $camera_ip
 * @property string $code Código
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property HousingEstate $housingEstate
 */
class SecurityCameras extends BeforeModel {

    public $unidad;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'security_cameras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'name', 'description', 'camera_ip', 'code'], 'required'],
            [['housing_estate_id', 'active'], 'integer'],
            [['created', 'modified', 'unidad'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['camera_ip', 'code', 'created_by', 'modified_by'], 'string', 'max' => 45],
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
            'name' => 'Nombre de la cámara',
            'description' => 'Descripción',
            'camera_ip' => 'IP Cámara',
            'code' => 'Código',
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
