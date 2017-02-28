<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Exercicio;
use common\models\ExerciciosPlano;
use common\models\ExercicioAerobicoPlano;
use common\models\ExercicioAnaerobicoPlano;

class ExerciciosPlanoForm extends Model
{
    private $idPlano;

    /** @var  array */
    public $keys;

    public $duracao;
    public $series;
    public $repeticoes;

    public function __construct($idPlano, array $config = [])
    {
        $this->idPlano = $idPlano;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['keys', 'each', 'rule' => ['integer']],
        ];
    }

    public function saveExerciciosPlano()
    {
        if (!$this->validate()) {
            return null;
        }

        foreach ($this->keys as $key) {
            $exercicio_plano = new ExerciciosPlano();
            $exercicio_plano->idPlano = $this->idPlano;
            $exercicio_plano->idExercicio = $key;
            $exercicio_plano->save();
        }

        return true;
    }

    public function saveDetalhesExerciciosPlano()
    {
        foreach ($this->keys as $key)
        {
            $exercicio_plano = ExerciciosPlano::findOne($key);

            if ($exercicio_plano) {
                $exercicio = Exercicio::findOne($exercicio_plano->idExercicio);
                if($exercicio) {
                    if ($exercicio->tipo_exercicio == 1) {

                        $exercicio_aerobico = new ExercicioAerobicoPlano();
                        $exercicio_aerobico->idExercicio = $exercicio_plano->idExercicio_plano;
                        $exercicio_aerobico->duracao = $this->duracao;
                        $exercicio_aerobico->save();

                    } elseif ($exercicio->tipo_exercicio == 2) {

                        $exercicio_anaerobico = new ExercicioAnaerobicoPlano();
                        $exercicio_anaerobico->idExercicio = $exercicio_plano->idExercicio_plano;
                        $exercicio_anaerobico->series = $this->series;
                        $exercicio_anaerobico->repeticoes = $this->repeticoes;
                        $exercicio_anaerobico->save();
                    }
                }
            }
        }
    }
}