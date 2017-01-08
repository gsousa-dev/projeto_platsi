<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\models\filters\ExerciciosPlanoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//-
use common\models\PlanoPessoal;
use common\models\ExerciciosPlano;
//-
use backend\models\forms\ExercicioPlanoForm as Form;

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
                    ['allow' => true, 'roles' => ['@']], //TODO: alterar para personal_trainer
                    ['allow' => false]
                ],
            ],
        ];
    }

    /**
     * Lists all ExerciciosPlano models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExerciciosPlanoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    /**
     * Creates a new ExerciciosPlano model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExerciciosPlano();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPlano' => $model->idPlano, 'idExercicio' => $model->idExercicio]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        return $this->redirect(['index']);
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

    public function actionAdicionarExercicio($idPlano)
    {
        $form = new Form();

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect(['view', 'idPlano' => $form->idPlano, 'idExercicio' => $form->idExercicio]);
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }
}
