<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reception;

/**
 * ReceptionSearch represents the model behind the search form about `common\models\Reception`.
 */
class ReceptionSearch extends Reception
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'region_id', 'gender', 'reception_type', 'status', 'reply_text'], 'integer'],
            [['name', 'address', 'email', 'phone', 'birth_date', 'message', 'file', 'unique_id', 'password', 'created_date', 'reply_date', 'reply_file'], 'safe'],
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
        $query = Reception::find();

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
            'district_id' => $this->district_id,
            'region_id' => $this->region_id,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'reception_type' => $this->reception_type,
            'status' => $this->status,
            'created_date' => $this->created_date,
            'reply_text' => $this->reply_text,
            'reply_date' => $this->reply_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'unique_id', $this->unique_id])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'reply_file', $this->reply_file]);

        return $dataProvider;
    }
}
