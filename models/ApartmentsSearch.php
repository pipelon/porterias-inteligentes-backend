<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Apartments;

/**
 * ApartmentsSearch represents the model behind the search form of `app\models\Apartments`.
 */
class ApartmentsSearch extends Apartments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'housing_estate_id', 'floor', 'active'], 'integer'],
            [['block', 'name', 'phone_number_1', 'phone_number_2', 'cellphone_number_1', 'cellphone_number_2', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
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
        $query = Apartments::find();

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
            'floor' => $this->floor,
            'active' => $this->active,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'block', $this->block])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone_number_1', $this->phone_number_1])
            ->andFilterWhere(['like', 'phone_number_2', $this->phone_number_2])
            ->andFilterWhere(['like', 'cellphone_number_1', $this->cellphone_number_1])
            ->andFilterWhere(['like', 'cellphone_number_2', $this->cellphone_number_2])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
