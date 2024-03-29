<?php
namespace api\modules\v1\controllers;

use backend\models\forms\UserForm;
use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;
//-
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;
//-
use common\models\User;
use common\models\Cliente;
use api\modules\v1\models\Session;
//-
use api\filters\RequestAuthorization;

final class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = ['class' => Cors::className()];
        $behaviors['authenticator'] = [
            'class' => RequestAuthorization::className(),
            'except' => ['options', 'authenticate', 'request-password-reset']
        ];

        return $behaviors;
    }

    public function actionChangePassword()
    {
        $request = Yii::$app->request;
        $user_id = $request->getHeaders()->get('USER-ID');
        $old_password = $request->post('old_password');
        $new_password = $request->post('password');

        if (empty($user_id)) {
            throw new UnauthorizedHttpException('Missing user id');
        }

        if (empty($old_password) || empty($new_password)){
            throw new UnauthorizedHttpException('Missing credentials.');
        }

        if (!($user = User::findOne(['id' => $user_id])) || ($user->status == 0)) {
            throw new NotFoundHttpException('Invalid user account.');
        }

        if (!$user->validatePassword($old_password)) {
            throw new UnauthorizedHttpException('Wrong credentials.');
        }

        $user->setPassword($new_password);
        $user->save();
    }

    public function actionAuthenticate()
    {
        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        if (empty($username) || empty($password)) {
            throw new UnauthorizedHttpException('Missing credentials.');
        }

        /**
         * Checks if user exists or if user was deleted
         */
        if (!($user = User::findOne(['username' => $username])) || ($user->status == 0)) {
            throw new NotFoundHttpException('Invalid user account.');
        }

        if (!$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Wrong credentials.');
        }

        $session = new Session();
        $session->access_token = $user->generateSessionToken();
        $session->userId = $user->id;

        if (!$session->save()) {
            throw new ServerErrorHttpException('Server error. Unable to create session.');
        }

        /**
         * returns client's personal trainer id
         * returns null if user's not a client
         */
        $idPersonal_trainer = ($cliente = Cliente::findOne(['idCliente' => $user->id])) ? $cliente->idPersonal_trainer : null;

        return (object) [
            'access_token' => $session->access_token,
            'id' => $user->id,
            'user_type' => $user->user_type,
            'idPersonal_trainer' => $idPersonal_trainer,
        ];
    }

    public function actionLogout ()
    {
        $access_token = Yii::$app->request->getHeaders()->get('ACCESS-TOKEN');

        if (empty($access_token)) {
            throw new UnauthorizedHttpException('Missing access token.');
        }

        if ($session = Session::findOne(['access_token' => $access_token])) {
            $session->delete();
        }
    }

    public function actionFilterByTypeOfUser()
    {
        $user_type = Yii::$app->request->getHeaders()->get('USER-TYPE');

        if (empty($user_type)) {
            throw new UnauthorizedHttpException('Missing user type.');
        }

        return User::find()->where(['user_type' => $user_type])->andWhere(['status' => 10])->all();
    }

    public function actionRequestPasswordReset()
    {
        $request = Yii::$app->request;
        $email = $request->post('email');

        if (empty($email)) {
            throw new UnauthorizedHttpException('Missing email.');
        }

        if ($user = User::findOne(['email' => $email])) {
            $user->sendEmail();
        }
    }
}