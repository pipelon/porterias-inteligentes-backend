<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gates_logs".
 *
 * @property int $id ID
 * @property int $gate_id Portería ID
 * @property int $state Estado
 * @property string $state_description Descripción
 * @property string $created Fecha
 *
 * @property Gates $gate
 */
class GatesLogs extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'gates_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['gate_id', 'state', 'state_description', 'created'], 'required'],
            [['gate_id', 'state'], 'integer'],
            [['created'], 'safe'],
            [['state_description'], 'string', 'max' => 45],
            [['gate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gates::className(), 'targetAttribute' => ['gate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'gate_id' => 'Portería',
            'state' => 'Estado',
            'state_description' => 'Descripción',
            'created' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGate() {
        return $this->hasOne(Gates::className(), ['id' => 'gate_id']);
    }

}
