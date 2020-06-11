<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccesscardsvehiclesLog;

/**
 * AccesscardsvehiclesLogSearch represents the model behind the search form of `app\models\AccesscardsvehiclesLog`.
 */
class AccesscardsvehiclesLogSearch extends AccesscardsvehiclesLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['accesscard_vehicle_code', 'state_description', 'created'], 'safe'],
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
        $query = AccesscardsvehiclesLog::find();

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
            'state' => $this->state,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'accesscard_vehicle_code', $this->accesscard_vehicle_code])
            ->andFilterWhere(['like', 'state_description', $this->state_description]);

        return $dataProvider;
    }
}
