<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property string $code Código
 * @property int $resident_id Residente
 * @property string $description Descripción
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Residents $resident
 * @property CardsLog[] $cardsLogs
 */
class Cards extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['code', 'resident_id', 'description', 'active'], 'required'],
            [['resident_id', 'active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['code'], 'string', 'max' => 20],
            [['description', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['code'], 'unique'],
            [['resident_id'], 'exist', 'skipOnError' => true, 'targetClass' => Residents::className(), 'targetAttribute' => ['resident_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'code' => 'Código',
            'resident_id' => 'Residente',
            'description' => 'Descripción',
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
    public function getResident() {
        return $this->hasOne(Residents::className(), ['id' => 'resident_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardsLogs() {
        return $this->hasMany(CardsLog::className(), ['card_code' => 'code']);
    }

}
