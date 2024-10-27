<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Translators;

/**
 * TranslatorsSearch represents the model behind the search form of `backend\models\Translators`.
 */
class TranslatorsSearch extends Translators
{
    public $language_from_id;
    public $language_to_id; 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language_from_id', 'language_to_id'], 'integer'],
            [['name', 'email'], 'safe'],
            [['available_weekdays', 'available_weekends'], 'boolean'],
            [['language_from_id', 'language_to_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Translators::find()->with('languageFrom', 'languageTo');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'available_weekdays' => $this->available_weekdays,
            'available_weekends' => $this->available_weekends,
            'language_from_id' => $this->language_from_id,
            'language_to_id' => $this->language_to_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
