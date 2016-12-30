<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
//-
use yii\web\UnauthorizedHttpException;
//-
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

    public function actionRoutine ()
    {
        /*
        $idExercicio_plano = Yii::$app->request->getHeaders()->get('EXERCISE-ID');
        $exercicio_plano = ExerciciosPlano::findOne(['idExercicio_plano' => $idExercicio_plano]);
        $exercicio = Exercicio::findOne(['idExercicio' => $exercicio_plano->idExercicio]);
        $tipo_exercicio = $exercicio->tipo_exercicio;
        $exercicio_aerobico = ExercicioAerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]);
        $exercicio_anaerobico = ExercicioAnaerobicoPlano::findOne(['idExercicio' => $exercicio_plano->idExercicio_plano]);
        */


        $plan_id = Yii::$app->request->getHeaders()->get('PLAN-ID');
        $exercises = ExerciciosPlano::find()->where(['idPlano' => $plan_id])->asArray()->all();
        //$exercises = ExerciciosPlano::find()->asArray()->all();

        foreach ($exercises as $exercise)
        {

        }
        /*
        $ids = ArrayHelper::map($exercises, 'idExercicio_plano', 'idExercicio');
        $ids_exercicios_plano = ArrayHelper::getColumn($exercises, 'idExercicio_plano');
        $ids_exercicios = ArrayHelper::getColumn($exercises, 'idExercicio');

        //return $ids;

        //return $ids_exercicios_plano;
        /*
        foreach ($ids_exercicios_plano as $idExercicio_plano) {
            echo 'idExercicio_plano - '.$idExercicio_plano.PHP_EOL;
        }
        */

        //return $ids_exercicios;
        /*
        foreach ($ids_exercicios as $idExercicio) {
            echo $idExercicio.' - ';
            $exercicio = Exercicio::findOne(['idExercicio' => $idExercicio]);
            echo $exercicio->descricao.PHP_EOL;
        }

        return null;


        if ($tipo_exercicio == 1) {
            return array(
                'Descrição' => $exercicio->descricao,
                'Duração' => $exercicio_aerobico->duracao
            );
        } else if ($tipo_exercicio == 2){
            return array(
                'Descrição' => $exercicio->descricao,
                'Séries' => $exercicio_anaerobico->series,
                'Repetições' => $exercicio_anaerobico->repeticoes
            );
        } else {
            return null;
        }

*/
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws UnauthorizedHttpException
     */
    public function actionFilterByPlan()
    {
        $plan_id = Yii::$app->request->getHeaders()->get('PLAN-ID');

        if (empty($plan_id)) {
            throw new UnauthorizedHttpException('Missing plan id');
        }

        return ExerciciosPlano::find()->where(['idPlano' => $plan_id])->all();
    }
}