<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use yii\web\UnauthorizedHttpException;
//-
use common\models\FotosDeProgresso;
//-
use api\filters\RequestAuthorization;

class FotosDeProgressoController extends ActiveController
{
    public $modelClass = 'common\models\FotosDeProgresso';

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

        return FotosDeProgresso::find()->where(['idCliente' => $user_id])->orderBy('data_foto')->all();
    }
}