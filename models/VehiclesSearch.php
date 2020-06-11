<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vehicles;

/**
 * VehiclesSearch represents the model behind the search form of `app\models\Vehicles`.
 */
class VehiclesSearch extends Vehicles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'apartment_id', 'type'], 'integer'],
            [['photo', 'license_plate', 'created', 'created_by', 'modified', 'modified_by'], 'safe'],
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
        $query = Vehicles::find();

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
            'apartment_id' => $this->apartment_id,
            'type' => $this->type,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'license_plate', $this->license_plate])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
