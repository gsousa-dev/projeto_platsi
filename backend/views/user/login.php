<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $loginForm \backend\models\forms\LoginForm*/
/* @var $passwordResetRequestForm \backend\models\forms\PasswordResetRequestForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'login-form']]); ?>
    <h3 class="form-title font-green">Sign In</h3>
    <?= $form->field($loginForm, 'username')->textInput() ?>
    <?= $form->field($loginForm, 'password')->passwordInput() ?>
    <div class="form-actions">
        <?= Html::submitButton('Login', ['class' => 'btn green uppercase', 'name' => 'login-button']) ?>
        <div style="display: inline-block">
            <?= $form->field($loginForm, 'rememberMe')->checkbox() ?>
        </div>
        <?= Html::a('Forgot Password?', "javascript:;", ['id' => 'forget-password', 'class' => 'forget-password']); ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'options' => ['class' => 'forget-form']]); ?>
    <h3 class="font-green">Forget Password ?</h3>
    <p> Enter your e-mail address below to reset your password. </p>
    <div class="form-group">
        <?= $form->field($passwordResetRequestForm, 'email')->textInput() ?>
    </div>
    <div class="form-actions">
        <?= Html::button('Back', ['id' => 'back-btn', 'class' => 'btn btn-default'])?>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success uppercase pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>