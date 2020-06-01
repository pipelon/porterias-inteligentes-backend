<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CardsLog;

/**
 * CardsLogSearch represents the model behind the search form of `app\models\CardsLog`.
 */
class CardsLogSearch extends CardsLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['state_description', 'created', 'code', 'card_code'], 'safe'],
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
        $query = CardsLog::find();

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

        $query->andFilterWhere(['like', 'state_description', $this->state_description])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'card_code', $this->card_code]);

        return $dataProvider;
    }
}
