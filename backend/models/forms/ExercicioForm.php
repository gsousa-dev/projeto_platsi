<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Exercicio;

class ExercicioForm extends Model
{
    public $descricao;
    public $tipo_exercicio;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'tipo_exercicio'], 'required'],
            [['descricao'], 'trim'],
            [['descricao'], 'string', 'max' => 45],
            [['tipo_exercicio'], 'integer'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $exercicio = new Exercicio();
        $exercicio->descricao = $this->descricao;
        $exercicio->tipo_exercicio = $this->tipo_exercicio;

        return $exercicio->save() ? $exercicio : null;
    }
}