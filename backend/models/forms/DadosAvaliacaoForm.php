<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\DadosAvaliacao;

class DadosAvaliacaoForm extends Model
{
    public $idCliente;
    public $altura;
    public $massa_corporal;
    public $massa_gorda;
    public $massa_muscular;
    public $agua_no_organismo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['altura', 'massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'required'],
            [['altura', 'massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'trim'],
            [['altura', 'massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['altura'], 'number', 'min' => 1.50],
            [['massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'number', 'min' => 30],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $dados_avaliacao = new DadosAvaliacao();
        $dados_avaliacao->idCliente = $this->idCliente;
        $dados_avaliacao->altura = $this->altura;
        $dados_avaliacao->massa_corporal = $this->massa_corporal;
        $dados_avaliacao->massa_gorda = $this->massa_gorda;
        $dados_avaliacao->massa_muscular = $this->massa_muscular;
        $dados_avaliacao->agua_no_organismo = $this->agua_no_organismo;

        return $dados_avaliacao->save() ? $dados_avaliacao : null;
    }
}