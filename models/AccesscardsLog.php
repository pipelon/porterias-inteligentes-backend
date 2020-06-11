<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accesscards_log".
 *
 * @property int $id ID
 * @property string $card_code Código tarjeta
 * @property int $state Estado
 * @property string $state_description Descripción
 * @property string $created Fecha
 *
 * @property Accesscards $cardCode
 */
class AccesscardsLog extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'accesscards_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['card_code', 'state', 'state_description', 'created'], 'required'],
            [['state'], 'integer'],
            [['state_description'], 'string'],
            [['created'], 'safe'],
            [['card_code'], 'string', 'max' => 20],
            [['card_code'], 'exist', 'skipOnError' => true, 'targetClass' => Accesscards::className(), 'targetAttribute' => ['card_code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'card_code' => 'Código tarjeta',
            'state' => 'Estado',
            'state_description' => 'Descripción',
            'created' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardCode() {
        return $this->hasOne(Accesscards::className(), ['code' => 'card_code']);
    }

}
