<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authorizations".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad Residencial
 * @property int $user_id Usuario
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property HousingEstate $housingEstate
 * @property Users $user
 */
class Authorizations extends BeforeModel {
    
    public $unidad;
    public $usuario;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'authorizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'user_id'], 'required'],
            [['housing_estate_id', 'user_id', 'active'], 'integer'],
            [['created', 'modified', 'unidad', 'usuario'], 'safe'],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['housing_estate_id'], 'exist', 'skipOnError' => true, 'targetClass' => HousingEstate::className(), 'targetAttribute' => ['housing_estate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'housing_estate_id' => 'Unidad Residencial',
            'user_id' => 'Usuario',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

}
