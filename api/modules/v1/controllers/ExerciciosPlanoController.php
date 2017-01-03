<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
//-
use yii\web\NotFoundHttpException;
//-
use common\models\PlanoPessoal;
use common\models\ExerciciosPlano;
use common\models\ExercicioAerobicoPlano;
use common\models\ExercicioAnaerobicoPlano;
use common\models\Exercicio;
//-
use api\filters\RequestAuthorization;

class ExerciciosPlanoController extends ActiveController
{
    public $modelClass = 'common\models\ExerciciosPlano';

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = ['class' => Cors::className()];
        $behaviors['authenticator'] = [
            'class' => RequestAuthorization::className(),
            'except' => ['options']
        ];

        return $behaviors;
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionRoutine ()
    {
        $plan_id = Yii::$app->request->getHeaders()->get('PLAN-ID'); //Plano que o cliente escolheu

        if (!($exercicios_plano = ExerciciosPlano::find()->where(['idPlano' => $plan_id])->all())) {
            throw new NotFoundHttpException('Invalid plan.');
        }

        foreach ($exercicios_plano as $exercicio_plano)
        {
            $exercicio = Exercicio::findOne(['idExercicio' => $exercicio_plano->idExercicio]); //Objeto do tipo Exercicio
            if ($exercicio->tipo_exercicio == 1) {
                $exercicio_aerobico = ExercicioAerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]); //Objeto do tipo ExercicioAerobicoPlano
                $duracao = $exercicio_aerobico->duracao;
                $reps = -1;
                $series = -1;
            } else if ($exercicio->tipo_exercicio == 2) {
                $exercicio_anaerobico = ExercicioAnaerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]); //Objeto do tipo ExercicioAnaerobicoPlano
                $duracao = -1;
                $series = $exercicio_anaerobico->series;
                $reps = $exercicio_anaerobico->repeticoes;
            }

            $result[] = [
                'idExercicio_plano' => $exercicio_plano->idExercicio_plano,
                'descricao' => $exercicio->descricao,
                'duracao' => $duracao,
                'series' => $series,
                'repeticoes' => $reps
            ];
            ArrayHelper::multisort($result, ['idExercicio_plano'], [SORT_ASC]);
        }

        return $result;
    }

    public function actionRoutines()
    {
        $user_id = Yii::$app->request->getHeaders()->get('USER-ID');
        $planos = PlanoPessoal::find()->where(['idCliente' => $user_id])->all();

        foreach ($planos as $plano)
        {
            $exercicios_plano = ExerciciosPlano::find()->where(['idPlano' => $plano->idPlano])->all(); //exercicios do plano em que o for esta

            foreach ($exercicios_plano as $exercicio_plano)
            {
                $exercicio = Exercicio::findOne(['idExercicio' => $exercicio_plano->idExercicio]);
                if ($exercicio->tipo_exercicio == 1) {
                    $exercicio_aerobico = ExercicioAerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]); //Objeto do tipo ExercicioAerobicoPlano
                    $duracao = $exercicio_aerobico->duracao;
                    $reps = -1;
                    $series = -1;
                } else if ($exercicio->tipo_exercicio == 2) {
                    $exercicio_anaerobico = ExercicioAnaerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]); //Objeto do tipo ExercicioAnaerobicoPlano
                    $duracao = -1;
                    $series = $exercicio_anaerobico->series;
                    $reps = $exercicio_anaerobico->repeticoes;
                }

                $result[] = [
                    'idPlano' => $plano->idPlano,
                    'idExercicio_plano' => $exercicio_plano->idExercicio_plano,
                    'descricao' => $exercicio->descricao,
                    'duracao' => $duracao,
                    'series' => $series,
                    'repeticoes' => $reps
                ];
                ArrayHelper::multisort($result, ['idExercicio_plano'], [SORT_ASC]);
            }
        }

        return $result;
    }
}