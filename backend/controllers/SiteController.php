<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'components' => [
                'errorHandler' => [
                    'errorAction' => 'site/error',
                ],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->renderPartial('error', ['exception' => $exception]);
        }
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')) {
            return $this->redirect('admin');
        } elseif (Yii::$app->user->can('secretaria')) {
            return $this->redirect('user');
        } elseif (Yii::$app->user->can('personal_trainer')) {
            return $this->redirect('cliente');
        } else {
            return $this->redirect('user/login');
        }
    }
}