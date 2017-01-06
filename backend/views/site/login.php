<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $loginModel \backend\models\forms\LoginForm*/
/* @var $passwordResetRequestModel \backend\models\forms\PasswordResetRequestForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'login-form']]); ?>
        <h3 class="form-title font-green">Sign In</h3>
        <?= $form->field($loginModel, 'username', [
                'template' => '<input type="text" id="loginform-username" class="form-control form-control-solid placeholder-no-fix" name="LoginForm[username]" placeholder="Username">',
            ]);
        ?>
        <?= $form->field($loginModel, 'password', [
                'template' => '<input type="password" id="loginform-password" class="form-control form-control-solid placeholder-no-fix" name="LoginForm[password]" placeholder="Password">',
            ]);
        ?>
        <div class="form-actions">
            <?= Html::submitButton('Login', ['class' => 'btn green uppercase', 'name' => 'login-button']) ?>
            <div style="display: inline-block">
                <?= $form->field($loginModel, 'rememberMe', [
                        'template' => '<label class="rememberme check"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]">Remember</label>',
                    ]);
                ?>
            </div>
            <?= Html::a('Forgot Password?', "javascript:;", ['id' => 'forget-password', 'class' => 'forget-password']); ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'options' => ['class' => 'forget-form']]); ?>
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <?= Html::activeTextInput($passwordResetRequestModel, 'email', ['id' => 'passwordresetrequestform-email', 'name' => 'PasswordResetRequestForm[email]', 'placeholder' => 'Email', 'class' => 'form-control placeholder-no-fix']); ?>
        </div>
        <div class="form-actions">
            <?= Html::button('Back', ['id' => 'back-btn', 'class' => 'btn btn-default'])?>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success uppercase pull-right']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>