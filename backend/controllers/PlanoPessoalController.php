<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\models\filters\PlanoPessoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//-
use common\models\Cliente;
use common\models\PlanoPessoal;

class PlanoPessoalController extends Controller
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
     * Lists all PlanoPessoal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanoPessoalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanoPessoal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PlanoPessoal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanoPessoal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPlano]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlanoPessoal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPlano]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the PlanoPessoal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlanoPessoal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanoPessoal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPlanos($idCliente)
    {
        $cliente = Cliente::findOne($idCliente);
        $planos = $cliente->getPlanos()->orderBy('descricao');

        $dataProvider = new ActiveDataProvider([
            'query' => $planos,
            'key' => 'idPlano'
        ]);

        return $this->render('planos-do-cliente', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
