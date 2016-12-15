<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use api\filters\RequestAuthorization;

class ObjetivoController extends ActiveController
{
    public $modelClass = 'common\models\Objetivo';

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
        ];

        return $behaviors;
    }
}