<?php
namespace api\modules\v1\controllers;

use Codeception\Lib\Console\Message;
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
            'except' => ['options']
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);

        return $actions;
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;

        $content = $request->post('mensagem');
        $idEmissor = $request->post('idEmissor');
        $idReceptor = $request->post('idReceptor');

        if (empty($content) || empty($idEmissor) || empty($idReceptor)) {
            throw new UnauthorizedHttpException('Missing credentials.');
        }

        $mensagem = new Mensagem();
        $mensagem->mensagem = $content;
        $mensagem->idEmissor = $idEmissor;
        $mensagem->idReceptor = $idReceptor;
        $mensagem->save();

        Mensagem::updateAll(['estado' => 'respondida'],['idEmissor' => $idReceptor]);
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

        return Mensagem::find()->where(['idEmissor' => $user_id])->orWhere(['idReceptor' => $user_id])->orderBy('data_envio')->all();
    }
}