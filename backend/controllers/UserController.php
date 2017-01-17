<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\bootstrap\Alert;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

use yii\data\ActiveDataProvider;
//-
use common\models\User;
use common\models\Mensagem;
//-
use backend\models\forms\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
//-
use backend\models\forms\CreateUserForm;
use backend\models\forms\UpdateUserForm;
use backend\models\forms\MensagemForm;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'roles' => ['admin', 'secretaria']],
                    ['allow' => true, 'actions' => ['login', 'reset-password'], 'roles' => ['?']],
                    ['allow' => false, 'actions' => ['dashboard'], 'roles' => ['secretaria', 'personal_trainer']],
                    [
                        'allow' => true,
                        'actions' => ['perfil', 'update', 'inbox', 'conversa', 'logout'],
                        'roles' => ['personal_trainer']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * Lista de utilizadores ativos que não são admins e que não o utilizador logado
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['<>', 'id', Yii::$app->user->id])->andWhere(['<>', 'user_type', 1])->andWhere(['status' => 10]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
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

    public function actionCreate()
    {
        $form = new CreateUserForm();

        if ($form->load(Yii::$app->request->post())) {
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($form->save()) {
                if($form->upload()) {
                    return $this->goHome();
                }
                return $this->goHome();
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
        $user = $this->findModel($id);
        $user->status = 0;

        if($user->save()) {
            return $this->goHome();
        }
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

    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $loginForm = new LoginForm();
        $passwordResetRequestForm = new PasswordResetRequestForm();

        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->goHome();
        } elseif ($passwordResetRequestForm->load(Yii::$app->request->post()) && $passwordResetRequestForm->validate()) {
            if ($passwordResetRequestForm->sendEmail()) {
                Alert::begin(['options' => ['class' => 'alert-success']]);
                echo 'Email enviado com sucesso.';
                Alert::end();
            } else {
                Alert::begin(['options' => ['class' => 'alert-warning']]);
                echo 'Falha no envio do email.';
                Alert::end();
            }
        }

        return $this->render('login', [
            'loginForm' => $loginForm,
            'passwordResetRequestForm' => $passwordResetRequestForm,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'login';

        try {
            $resetPasswordForm = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($resetPasswordForm->load(Yii::$app->request->post()) && $resetPasswordForm->validate() && $resetPasswordForm->resetPassword()) {
            return $this->redirect('/site/index');
        }

        return $this->render('resetPassword', [
            'resetPasswordForm' => $resetPasswordForm,
        ]);
    }

    public function actionInbox()
    {
        $current_user = $this->findModel(Yii::$app->getUser()->id);
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

    public function actionEditarPerfil($id)
    {
        $model = $this->findModel($id);

        $form = new UpdateUserForm();
        $form->id = $id;
        $form->username = $model->username;

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect(['perfil', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'updateUserForm' => $form,
            ]);
        }
    }
}