<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;
//-
use common\models\User;
use api\modules\v1\models\Session;
//-
use api\filters\RequestAuthorization;

final class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = ['class' => Cors::className()];
        $behaviors['authenticator'] = [
            'class' => RequestAuthorization::className(),
            'except' => ['options', 'authenticate']
        ];

        return $behaviors;
    }

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

        return (object) [
            'token' => $session->access_token,
            'user' => (object) [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ];
    }
}
