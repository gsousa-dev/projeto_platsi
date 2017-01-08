<?php

namespace backend\models\filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PlanoPessoal;

/**
 * PlanoPessoalSearch represents the model behind the search form about `common\models\PlanoPessoal`.
 */
class PlanoPessoalSearch extends PlanoPessoal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPlano', 'idCliente'], 'integer'],
            [['descricao'], 'safe'],
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
        $query = PlanoPessoal::find();

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
            'idPlano' => $this->idPlano,
            'idCliente' => $this->idCliente,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
