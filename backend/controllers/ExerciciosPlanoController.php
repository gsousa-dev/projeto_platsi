<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
//-
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//-
use backend\models\filters\ExercicioSearch;
//-
use backend\models\forms\DetalhesExerciciosPlanoForm;
use backend\models\forms\ExerciciosPlanoForm;
//-
use common\models\PlanoPessoal;
use common\models\ExerciciosPlano;
use common\models\Exercicio;
use common\models\ExercicioAerobicoPlano;
use common\models\ExercicioAnaerobicoPlano;


class ExerciciosPlanoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => false, 'roles' => ['?']],
                    ['allow' => true, 'roles' => ['personal_trainer']],
                    ['allow' => false]
                ],
            ],
        ];
    }

    /**
     * Displays a single ExerciciosPlano model.
     * @param integer $idPlano
     * @param integer $idExercicio
     * @return mixed
     */
    public function actionView($idPlano, $idExercicio)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPlano, $idExercicio),
        ]);
    }

    public function actionCreate($idPlano)
    {
        $searchModel = new ExercicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new ExerciciosPlanoForm($idPlano);

        if (isset($_POST['keylist'])) {
            $keys = $_POST['keylist'];
            if(is_array($keys)) {
                $model->keys = $keys;
                if($model->saveExerciciosPlano()) {

//                    return $this->redirect('/exercicios-plano/detalhes-exercicios?idPlano=' . $idPlano);
                    return $this->redirect('/exercicios-plano/plano-de-treino?idPlano=' . $idPlano);
                }
            }
        }

        return $this->render('create', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetalhesExercicios($idPlano)
    {
        $exercicios_plano = ExerciciosPlano::find()->where(['idPlano' => $idPlano]);

        return $this->render('detalhes-exercicios-plano', [
            'exercicios_plano' => $exercicios_plano,

        ]);
    }

    /**
     * Updates an existing ExerciciosPlano model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPlano
     * @param integer $idExercicio
     * @return mixed
     */
    public function actionUpdate($idPlano, $idExercicio)
    {
        $model = $this->findModel($idPlano, $idExercicio);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPlano' => $model->idPlano, 'idExercicio' => $model->idExercicio]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ExerciciosPlano model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idPlano
     * @param integer $idExercicio
     * @return mixed
     */
    public function actionDelete($idPlano, $idExercicio)
    {
        $this->findModel($idPlano, $idExercicio)->delete();

        return $this->goBack();
    }

    /**
     * Finds the ExerciciosPlano model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idPlano
     * @param integer $idExercicio
     * @return ExerciciosPlano the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPlano, $idExercicio)
    {
        if (($model = ExerciciosPlano::findOne(['idPlano' => $idPlano, 'idExercicio' => $idExercicio])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPlanoDeTreino($idPlano)
    {
        $plano = PlanoPessoal::findOne($idPlano);
        $exercicios_plano = $plano->getExerciciosPlano()->orderBy('idExercicio_plano');

        $dataProvider = new ActiveDataProvider([
            'query' => $exercicios_plano,
        ]);

        return $this->render('exercicios-plano', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
