<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use yii\web\UnauthorizedHttpException;
//-
use common\models\Mensagem;
//-
use api\filters\RequestAuthorization;

class MensagemController extends ActiveController
{
    public $modelClass = 'common\models\Mensagem';

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
        ];

        return $behaviors;
    }

    public function actionFilterByUser()
    {
        $user_id = Yii::$app->request->getHeaders()->get('USER-ID');

        if (empty($user_id)) {
            throw new UnauthorizedHttpException('Missing user id');
        }

        return Mensagem::find()->where(['idEmissor' => $user_id])->orWhere(['idReceptor' => $user_id])->orderBy('data_envio')->all();
    }
}