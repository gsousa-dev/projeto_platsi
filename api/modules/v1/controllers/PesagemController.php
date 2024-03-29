<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use yii\web\UnauthorizedHttpException;
//-
use common\models\Pesagem;
//-
use api\filters\RequestAuthorization;

class PesagemController extends ActiveController
{
    public $modelClass = 'common\models\Pesagem';

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
            'except' => ['options']
        ];

        return $behaviors;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws UnauthorizedHttpException
     */
    public function actionFilterByUser()
    {
        $user_id = Yii::$app->request->getHeaders()->get('USER-ID');

        if (empty($user_id)) {
            throw new UnauthorizedHttpException('Missing user id');
        }

        return Pesagem::find()->where(['idCliente' => $user_id])->orderBy('data_pesagem DESC')->all();
    }
}