<?php

namespace backend\controllers;

use yii\web\Controller;

class UserRegistrationController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
