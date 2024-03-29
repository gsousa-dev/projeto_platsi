<?php
namespace backend\models\filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Exercicio;

class ExercicioSearch extends Exercicio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idExercicio', 'tipo_exercicio'], 'integer'],
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
        $query = Exercicio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idExercicio' => $this->idExercicio,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao]);
        $query->andFilterWhere(['like', 'tipo_exercicio', $this->tipo_exercicio]);

        return $dataProvider;
    }
}
