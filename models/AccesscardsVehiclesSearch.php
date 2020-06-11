<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccesscardsVehicles;

/**
 * AccesscardsVehiclesSearch represents the model behind the search form of `app\models\AccesscardsVehicles`.
 */
class AccesscardsVehiclesSearch extends AccesscardsVehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'description', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
            [['vehicle_id', 'active'], 'integer'],
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
        $query = AccesscardsVehicles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'vehicle_id' => $this->vehicle_id,
            'active' => $this->active,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
