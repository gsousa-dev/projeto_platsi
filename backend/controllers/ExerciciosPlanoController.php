<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
//-
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//-
use common\models\ExerciciosPlano;

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
}
