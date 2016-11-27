<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\password\PasswordInput;

/* @var $model \backend\models\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['class' => 'login-form']]); ?>
        <h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>
        <p>Please choose your new password:</p>
        <?= $form->field($model, 'password', [
                'template' => '<input type="password" id="resetpasswordform-password" class="form-control form-control-solid placeholder-no-fix" name="ResetPasswordForm[password]" placeholder="Password">',
            ]);
        ?>
        <div class="form-actions">
            <?= Html::submitButton('Save', ['class' => 'btn green uppercase']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

