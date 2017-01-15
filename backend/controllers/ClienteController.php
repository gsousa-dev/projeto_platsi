<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//-
use common\models\User;
use common\models\Cliente;
use common\models\PlanoPessoal;
use common\models\Exercicio;
use common\models\Objetivo;
use common\models\DadosAvaliacao;
//-
use backend\models\forms\PlanoDeTreinoForm;
use backend\models\forms\ObjetivoForm;
use backend\models\forms\DadosAvaliacaoForm;

class ClienteController extends Controller
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
                    ['allow' => true, 'roles' => ['personal_trainer']],
                    ['allow' => false]
                ],
            ],
        ];
    }

    /**
     * Lista de Clientes do Personal Trainer
     */
    public function actionIndex()
    {
        $current_user = User::findOne(Yii::$app->getUser()->id);
        $clientes = $current_user->getClientes();

        $dataProvider = new ActiveDataProvider([
            'query' => $clientes,
        ]);

        return $this->render('meus-clientes', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
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
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCliente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCliente]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFicha($idCliente)
    {
        $cliente = Cliente::findOne($idCliente);

        $cliente_info = $cliente->getCliente();
        $clienteDataProvider = new ActiveDataProvider([
            'query' => $cliente_info,
        ]);

        $objetivo = $cliente->getObjetivo();
        $objetivoDataProvider = new ActiveDataProvider([
            'query' => $objetivo,
        ]);

        $dadosAvaliacao = $cliente->getDadosAvaliacao();
        $dadosAvaliacaoDataProvider = new ActiveDataProvider([
            'query' => $dadosAvaliacao,
        ]);

        $planos = $cliente->getPlanos()->orderBy('descricao');
        $planosDataProvider = new ActiveDataProvider([
            'query' => $planos,
        ]);


        return $this->render('ficha', [
            'idCliente' => $idCliente,
            'cliente' => $clienteDataProvider,
            'objetivo' => $objetivoDataProvider,
            'objetivo_exists' => $objetivo->count(),
            'dadosAvaliacao' => $dadosAvaliacaoDataProvider,
            'dadosAvaliacao_exists' => $dadosAvaliacao->count(),
            'planos' => $planosDataProvider,
            'planos_cont' => $planos->count(),
        ]);
    }

    public function actionPlanos($idCliente)
    {
        $cliente = Cliente::findOne($idCliente);
        $planos = $cliente->getPlanos()->orderBy('descricao');

        $dataProvider = new ActiveDataProvider([
            'query' => $planos,
        ]);

        return $this->render('planos/index', [
            'dataProvider' => $dataProvider,
            'idCliente' => $idCliente,
        ]);
    }

    public function actionNovoPlano($idCliente)
    {
        $form = new PlanoDeTreinoForm();
        $form->idCliente = $idCliente;

        $exercicios = Exercicio::find();
        $exerciciosDataProvider = new ActiveDataProvider([
            'query' => $exercicios,
            'pagination' => false,
        ]);

        if ($form->load(Yii::$app->request->post()) && $form->save()) {

        }

        return $this->render('planos/create', [
            'exercicios' => $exerciciosDataProvider,
            'planoPessoalModel' => $form,
        ]);
    }

    protected function findObjetivoModel($idCliente)
    {
        if (($model = Objetivo::findOne($idCliente)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function actionNovoObjetivo($idCliente)
    {
        $form = new ObjetivoForm();
        $form->idCliente = $idCliente;

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->actionFicha($idCliente);
        }

        return $this->render('objetivos/create', [
            'objetivoForm' => $form,
        ]);
    }

    public function actionEditarObjetivo($idCliente)
    {
        $model = $this->findObjetivoModel($idCliente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->actionFicha($idCliente);
        }

        return $this->render('objetivos/update', [
            'model' => $model,
        ]);
    }

    public function actionApagarObjetivo($idCliente)
    {
        $this->findObjetivoModel($idCliente)->delete();

        return $this->actionFicha($idCliente);
    }

    protected function findDadosAvaliacaoModel($idCliente)
    {
        if (($model = DadosAvaliacao::findOne($idCliente)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function actionRegistarAvaliacaoFisica($idCliente)
    {
        $form = new DadosAvaliacaoForm();
        $form->idCliente = $idCliente;

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->actionFicha($idCliente);
        }

        return $this->render('dados-avaliacao/create', [
            'dadosAvaliacaoForm' => $form,
        ]);
    }

    public function actionEditarDadosAvaliacao($idCliente)
    {
        $model = $this->findDadosAvaliacaoModel($idCliente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->actionFicha($idCliente);
        }

        return $this->render('dados-avaliacao/update', [
            'model' => $model,
        ]);
    }

    public function actionApagarDadosAvaliacao($idCliente)
    {
        $this->findDadosAvaliacaoModel($idCliente)->delete();

        return $this->actionFicha($idCliente);
    }
}
