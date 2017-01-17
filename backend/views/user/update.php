<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $updateUserForm backend\models\forms\UpdateUserForm */

$this->title = 'Editar dados do utilizador';
?>
<div class="user-update">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"></a>
            </li>
            <li class="active"></li>
        </ol>
    </div>
    <p></p>

    <?php $form = ActiveForm::begin(['options' => ['id' => 'update-user-form', 'role' => 'form']]); ?>

    <?= $form->field($updateUserForm, 'name')->textInput(['value' => $model->name])->label('Nome completo') ?>

    <?= $form->field($updateUserForm, 'username')->textInput(['value' => $model->username])->label() ?>

    <?= $form->field($updateUserForm, 'new_password')->passwordInput(['placeholder' => '********'])->label() ?>

    <?= $form->field($updateUserForm, 'email')->textInput(['value' => $model->email])->label() ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>