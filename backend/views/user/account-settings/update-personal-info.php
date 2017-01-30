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
        <li class="active">
            <a href="#">Personal Info</a>
        </li>
        <li>
            <a href="/user/change-avatar">Change Avatar</a>
        </li>
        <li>
            <a href="/user/change-password">Change Password</a>
        </li>
    </ul>
</div>
<div class="portlet-body">
    <div class="tab-content">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'update-personal-info-form', 'role' => 'form']]); ?>

        <?= $form->field($model, 'name')->textInput(['value' => $model->name]) ?>

        <?= $form->field($model, 'username')->textInput(['value' => $model->username]) ?>

        <?= $form->field($model, 'email')->textInput(['value' => $model->email]) ?>

        <?= Html::submitButton('Guardar', ['class' => 'btn green']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

