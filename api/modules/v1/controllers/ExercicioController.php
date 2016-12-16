<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use common\models\Exercicio;
//-
use api\filters\RequestAuthorization;

class ExercicioController extends ActiveController
{
    public $modelClass = 'common\models\Exercicio';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = ['class' => Cors::className()];
        $behaviors['authenticator'] = [
            'class' => RequestAuthorization::className(),
            'except' => ['options', 'count']
        ];

        return $behaviors;
    }

    public function actionCount()
    {
        return Exercicio::find()->count();
    }
}