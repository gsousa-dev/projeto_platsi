<?php

namespace backend\models\filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExerciciosPlano;

/**
 * ExerciciosPlanoSearch represents the model behind the search form about `common\models\ExerciciosPlano`.
 */
class ExerciciosPlanoSearch extends ExerciciosPlano
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idExercicio_plano', 'idPlano', 'idExercicio'], 'integer'],
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
        $query = ExerciciosPlano::find();

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
            'idExercicio_plano' => $this->idExercicio_plano,
            'idPlano' => $this->idPlano,
            'idExercicio' => $this->idExercicio,
        ]);

        return $dataProvider;
    }
}
