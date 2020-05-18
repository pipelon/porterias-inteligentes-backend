<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "housing_estate_security_guard".
 *
 * @property int $id ID
 * @property int $housing_estate_id Unidad residencial
 * @property int $security_guard_id Portero
 *
 * @property HousingEstate $housingEstate
 */
class HousingEstateSecurityGuard extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'housing_estate_security_guard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['housing_estate_id', 'security_guard_id'], 'required'],
            [['housing_estate_id', 'security_guard_id'], 'integer'],
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
            'security_guard_id' => 'Portero',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHousingEstate() {
        return $this->hasOne(HousingEstate::className(), ['id' => 'housing_estate_id']);
    }

}
