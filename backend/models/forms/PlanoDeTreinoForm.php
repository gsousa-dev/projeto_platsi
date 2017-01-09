<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\PlanoPessoal;

class PlanoDeTreinoForm extends Model
{
    public $descricao;
    public $idCliente;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'trim'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $plano = new PlanoPessoal();
        $plano->descricao = $this->descricao;
        $plano->idCliente = $this->idCliente;

        return $plano->save() ? $plano : null;
    }
}