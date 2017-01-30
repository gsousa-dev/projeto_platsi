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
        <li class="active">
            <a href="#">Change Avatar</a>
        </li>
        <li>
            <a href="/user/change-password">Change Password</a>
        </li>
    </ul>
</div>
<div class="portlet-body">
    <div class="tab-content">
            <div class="fileinput fileinput-new">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="/<?= $model->profile_picture ?>" alt="profile_picture">
                </div>
            </div>
            <div>
                <?php $form = ActiveForm::begin(['options' => ['id' => 'change-avatar-form', 'role' => 'form']]) ?>

                <?= $form->field($model, 'avatar')->fileInput()->label(false) ?>

                <?= Html::submitButton('Guardar', ['class' => 'btn green']) ?>

                <?php ActiveForm::end() ?>
            </div>
    </div>
</div>

