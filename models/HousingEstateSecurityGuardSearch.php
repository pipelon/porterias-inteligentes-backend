<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HousingEstateSecurityGuard;

/**
 * HousingEstateSecurityGuardSearch represents the model behind the search form of `app\models\HousingEstateSecurityGuard`.
 */
class HousingEstateSecurityGuardSearch extends HousingEstateSecurityGuard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'housing_estate_id', 'id_user', 'active'], 'integer'],
            [['created', 'created_by', 'modified', 'modified_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HousingEstateSecurityGuard::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'housing_estate_id' => $this->housing_estate_id,
            'id_user' => $this->id_user,
            'active' => $this->active,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);
        
        $query->groupBy('id_user');

        return $dataProvider;
    }
}
