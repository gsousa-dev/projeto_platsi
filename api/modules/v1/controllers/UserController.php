<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
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
            'except' => ['options', 'authenticate']
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @return object
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws UnauthorizedHttpException
     */
    public function actionAuthenticate()
    {
        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        if (empty($username) || empty($password)) {
            throw new UnauthorizedHttpException('Missing credentials.');
        }

        if (!($user = User::findOne(['username' => $username]))) {
            throw new NotFoundHttpException('Invalid user account.');
        }

        if (!$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Wrong credentials.');
        }

        $session = new Session();
        $session->access_token = $user->generateSessionToken();
        $session->userId = $user->id;

        if (!$session->save()) {
            throw new ServerErrorHttpException('Server error. Unable to create session id.');
        }

        if ($cliente = Cliente::findOne(['idCliente' => $user->id])) {
            $idPersonal_trainer = $cliente->idPersonal_trainer;
        } else {
            $idPersonal_trainer = null;
        }

        return (object) [
            'access_token' => $session->access_token,
            'id' => $user->id,
            'user_type' => $user->user_type,
            'idPersonal_trainer' => $idPersonal_trainer,
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws UnauthorizedHttpException
     */
    public function actionFilterByTypeOfUser()
    {
        $user_type = Yii::$app->request->getHeaders()->get('USER-TYPE');

        if (empty($user_type)) {
            throw new UnauthorizedHttpException('Missing user type');
        }

        return User::find()->where(['user_type' => $user_type])->andWhere(['status' => 10])->all();
    }

    public function actionRequestPasswordReset()
    {
        $request = Yii::$app->request;
        $email = $request->post('email');

        if ($user = User::findOne(['email' => $email])) {
            $user->sendEmail();
        }
    }
}
