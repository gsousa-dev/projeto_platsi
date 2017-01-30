<?php
namespace backend\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

use yii\base\InvalidParamException;

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
                        'actions' => [
                            'profile',
                            'update-personal-info',
                            'change-avatar',
                            'change-password',
                            'inbox',
                            'conversa',
                            'logout'
                        ],
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

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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

        return $this->render('active-users', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new CreateUserForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //User created successfully
            //TODO: User created successfully confirmation
        }

        return $this->render('new-user', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        $user->status = 0;

        return $user->save() ? true : false;
    }

    public function actionProfile($id)
    {
        return $this->render('profile', [
            'user' => $this->findModel($id)
        ]);
    }

    public function actionUpdatePersonalInfo()
    {
        $id = Yii::$app->user->identity->getId();
        $user = $this->findModel($id);

        $model = new UpdateUserForm($user, ['scenario' => UpdateUserForm::SCENARIO_UPDATE_PERSONAL_INFO]);

        if ($model->load(Yii::$app->request->post()) && $model->updatePersonalInfo()) {
            //Success
            return $this->refresh(); //TODO: Success confirmation
        } else {
            return $this->render('account-layout', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }

    public function actionChangeAvatar()
    {
        $id = Yii::$app->user->identity->getId();
        $user = $this->findModel($id);

        $model = new UpdateUserForm($user, ['scenario' => UpdateUserForm::SCENARIO_CHANGE_AVATAR]);

        if (Yii::$app->request->isPost) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->upload() && $model->saveAvatarInDb()) {
                //File is uploaded successfully and saved in db
                return $this->refresh();
            } else {
                //Error uploading avatar
                //TODO: Error uploading avatar confirmation
            }
        } else {
            return $this->render('account-layout', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword()
    {
        $id = Yii::$app->user->identity->getId();
        $user = $this->findModel($id);

        $model = new UpdateUserForm($user, ['scenario' => UpdateUserForm::SCENARIO_CHANGE_PASSWORD]);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            //Success
            return $this->refresh(); //TODO: Success confirmation
        } else {
            return $this->render('account-layout', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
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
                // Email sent successfully
                //TODO: Email sent successfully confirmation
            } else {
                //Email not sent
                //TODO: Email not sent confirmation
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

        return $this->render('messages/inbox', [
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
        } else {
            return $this->render('messages/chat', [
                'dataProvider' => $dataProvider,
                'model' => $form,
            ]);
        }
    }
}