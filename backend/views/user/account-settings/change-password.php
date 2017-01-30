<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model backend\models\forms\UpdateUserForm */

?>

<div class="portlet-title tabbable-line">
    <div class="caption caption-md">
        <i class="icon-globe theme-font hide"></i>
        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
    </div>
    <ul class="nav nav-tabs">
        <li>
            <a href="/user/update-personal-info">Personal Info</a>
        </li>
        <li>
            <a href="/user/change-avatar">Change Avatar</a>
        </li>
        <li class="active">
            <a href="#">Change Password</a>
        </li>
    </ul>
</div>
<div class="portlet-body">
    <div class="tab-content">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'change-password-form', 'role' => 'form']]); ?>

        <?= $form->field($model, 'old_password')->passwordInput() ?>
        <?= $form->field($model, 'new_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
