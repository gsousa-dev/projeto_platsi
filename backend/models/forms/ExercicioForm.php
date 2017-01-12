<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Exercicio;
use common\models\TipoExercicio;

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
            //[['descricao'], 'unique'],
            [['descricao'], 'string', 'max' => 45],
            [['tipo_exercicio'], 'integer'],
            [['tipo_exercicio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoExercicio::className(), 'targetAttribute' => ['tipo_exercicio' => 'id']],
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