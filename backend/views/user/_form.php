<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//-
use common\models\UserType;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */

$user_types = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->all(), 'id', 'user_type'); //Apanhar o id do tipo de utilizador
?>

<div class="user-form">
    <p>Preencha os seguintes campos para criar um novo utilizador:</p>

    <?php $form = ActiveForm::begin(['options' => ['role' => 'form']]); ?>

    <?= $form->field($model, 'user_type')->dropDownList($user_types) ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList(['F' => 'Feminino', 'M' => 'Masculino']) ?>

    <?= $form->field($model, 'profile_picture')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
