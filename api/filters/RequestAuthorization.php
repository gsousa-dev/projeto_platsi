<?php

namespace api\filters;

use Yii;
use yii\base\ActionFilter;
use yii\filters\auth\AuthInterface;
use yii\web\UnauthorizedHttpException;
//-
use api\modules\v1\models\Session;
//-

final class RequestAuthorization extends ActionFilter implements AuthInterface {

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $response = Yii::$app->getResponse();
        if ($this->authenticate(Yii::$app->getUser(), Yii::$app->getRequest(), $response) !== null) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function authenticate($_user, $request, $response) {
        $headers = $request->getHeaders();

        if (empty($headers['ACCESS-TOKEN']) ||
            !($session = Session::findOne(['access_token' => $headers['ACCESS-TOKEN']]))) {

            throw new UnauthorizedHttpException('Wrong credentials.');
        }
        $user = $session->user;
        $_user->switchIdentity($user);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function challenge($response) {
        //NOTE: DO NOTHING
    }

    /**
     * @inheritdoc
     */
    public function handleFailure($response) {
        //NOTE: DO NOTHING
    }

}
