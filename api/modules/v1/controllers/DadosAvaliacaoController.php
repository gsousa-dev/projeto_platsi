<?php
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;
//-
use api\filters\RequestAuthorization;

class DadosAvaliacaoController extends ActiveController
{
    public $modelClass = 'common\models\DadosAvaliacao';

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
}