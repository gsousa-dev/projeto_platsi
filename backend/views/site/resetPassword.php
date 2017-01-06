<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $model \backend\models\forms\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['class' => 'login-form']]); ?>
        <h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>
        <p>Please choose your new password:</p>
        <?= $form->field($model, 'password', [
                'template' => '<input style="display: inline-block; width: 90%;" type="password" id="resetpasswordform-password" class="form-control form-control-solid placeholder-no-fix" name="ResetPasswordForm[password]" placeholder="Password">
                               <img src="../assets/pages/img/toogle-password" onmousedown="showPassword();" onmouseup="hidePassword();">'
            ]);
        ?>
        <div style="margin-top: -20px;" class="form-actions">
            <?= Html::submitButton('Save', ['class' => 'btn green uppercase']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function showPassword(){
        var pass = document.getElementById('resetpasswordform-password');
        pass.setAttribute('type', 'text');
    }
    function hidePassword() {
        var pass = document.getElementById('resetpasswordform-password');
        pass.setAttribute('type', 'password');
    }
</script>