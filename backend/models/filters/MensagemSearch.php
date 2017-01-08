<?php

namespace backend\models\filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mensagem;

/**
 * MensagemSearch represents the model behind the search form about `common\models\Mensagem`.
 */
class MensagemSearch extends Mensagem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMensagem', 'idEmissor', 'idReceptor'], 'integer'],
            [['mensagem', 'data_envio'], 'safe'],
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
        $query = Mensagem::find();

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
            'idMensagem' => $this->idMensagem,
            'data_envio' => $this->data_envio,
            'idEmissor' => $this->idEmissor,
            'idReceptor' => $this->idReceptor,
        ]);

        $query->andFilterWhere(['like', 'mensagem', $this->mensagem]);

        return $dataProvider;
    }
}
