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
        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
        <div style="margin-top: -20px;" class="form-actions">
            <?= Html::submitButton('Save', ['class' => 'btn green uppercase']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>