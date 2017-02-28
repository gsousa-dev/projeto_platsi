<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Pesagem;

class PesagemForm extends Model
{
    private $idCliente;

    public $data_pesagem;
    public $peso;

    public function __construct($idCliente, array $config = [])
    {
        $this->idCliente = $idCliente;

        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'data_pesagem' => 'Data',
            'peso' => 'Peso'
        ];
    }

    public function rules()
    {
        return [
            [['peso'], 'required', 'message' => 'Campo de preenchimento obrigatório'],
            [['peso'], 'number', 'min' => 40, 'max' => 300]
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $pesagem = new Pesagem();
        $pesagem->data_pesagem = date('y-m-d h:i:s');
        $pesagem->peso = $this->peso;
        $pesagem->idCliente = $this->idCliente;

        return $pesagem->save() ? $pesagem : null;
    }
}