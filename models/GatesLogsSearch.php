<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GatesLogs;

/**
 * GatesLogsSearch represents the model behind the search form of `app\models\GatesLogs`.
 */
class GatesLogsSearch extends GatesLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gate_id', 'state'], 'integer'],
            [['state_description', 'created'], 'safe'],
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
        $query = GatesLogs::find();

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
            'gate_id' => $this->gate_id,
            'state' => $this->state,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'state_description', $this->state_description]);

        return $dataProvider;
    }
}
