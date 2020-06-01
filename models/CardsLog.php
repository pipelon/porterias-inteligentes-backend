<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards_log".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $state_description Descripción
 * @property string $created Fecha
 * @property string $code
 * @property string $card_code Código tarjeta
 *
 * @property Cards $cardCode
 */
class CardsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cards_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'state_description', 'created', 'card_code'], 'required'],
            [['state'], 'integer'],
            [['state_description'], 'string'],
            [['created'], 'safe'],
            [['card_code'], 'string', 'max' => 20],
            [['card_code'], 'exist', 'skipOnError' => true, 'targetClass' => Cards::className(), 'targetAttribute' => ['card_code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'Estado',
            'state_description' => 'Descripción',
            'created' => 'Fecha',
            'card_code' => 'Código tarjeta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardCode()
    {
        return $this->hasOne(Cards::className(), ['code' => 'card_code']);
    }
}
