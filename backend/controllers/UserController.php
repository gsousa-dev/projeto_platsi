<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
//-
use common\models\User;
use common\models\Mensagem;
//-
use backend\models\forms\UserForm as Form;
use backend\models\forms\MensagemForm;

class UserController extends Controller
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
                    [
                        'allow' => false,
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update', 'inbox', 'conversa'],
                        'roles' => ['personal_trainer']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin', 'secretaria'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['<>', 'id', Yii::$app->user->id])->andWhere(['status' => 10]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionPerfil($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new Form();

        if ($form->load(Yii::$app->request->post())) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($form->save()) {
                if($form->upload()) {
                    return $this->goHome();
                } else {

                }

            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionApagar($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;

        if($model->save()) {
            return $this->goHome();
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInbox()
    {
        $current_user = $this->findModel(Yii::$app->user->id);
        $inbox_messages = $current_user->getInbox()->where(['estado' => 'por responder'])->orderBy('data_envio DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $inbox_messages,
        ]);

        return $this->render('mensagens/inbox', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConversa($idCliente)
    {
        $chat = Mensagem::find()->where(['idEmissor' => $idCliente])->orWhere(['idReceptor' => $idCliente])->orderBy('data_envio DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $chat,
        ]);

        $form = new MensagemForm();
        $form->idReceptor = $idCliente;

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->refresh();
        }

        return $this->render('mensagens/chat', [
            'dataProvider' => $dataProvider,
            'model' => $form,
        ]);
    }
}
