<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\PlanoPessoal;

class PlanoPessoalForm extends Model
{
    private $idCliente;

    /** @var string */
    public $descricao;


    public function attributeLabels()
    {
        return ['descricao' => 'Defina o nome do plano de treino:'];
    }

    public function __construct($idCliente, array $config = [])
    {
        $this->idCliente = $idCliente;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 50],
        ];
    }

    public function savePlanoPessoal()
    {
        if (!$this->validate()) {
            return null;
        }

        $planoPessoal = new PlanoPessoal();

        $planoPessoal->descricao = $this->descricao;
        $planoPessoal->idCliente = $this->idCliente;

        return $planoPessoal->save() ? $planoPessoal : null;
    }
}