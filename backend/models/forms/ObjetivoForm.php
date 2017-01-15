<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Objetivo;

class ObjetivoForm extends Model
{
    public $idCliente;
    public $objetivo;
    public $peso_pretendido;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivo', 'peso_pretendido'], 'required'],
            [['objetivo'], 'trim'],
            [['objetivo'], 'string', 'max' => 50],
            [['peso_pretendido'], 'number'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $objetivo = new Objetivo();
        $objetivo->idCliente = $this->idCliente;
        $objetivo->objetivo = $this->objetivo;
        $objetivo->peso_pretendido = $this->peso_pretendido;

        return $objetivo->save() ? $objetivo : null;
    }
}