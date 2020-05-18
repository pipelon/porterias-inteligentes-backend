<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "security_guards".
 *
 * @property int $id ID
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property int $user_id
 *
 * @property Users $user
 */
class SecurityGuards extends BeforeModel {
    
    public $housing_estates;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'security_guards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['active', 'user_id'], 'required'],
            [['active', 'user_id'], 'integer'],
            [['created', 'modified', 'housing_estates'], 'safe'],
            [['created_by', 'modified_by'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'active' => 'Activo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'user_id' => 'Portero',
            'housing_estates' => 'Unidades residenciales',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

}
